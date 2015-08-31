<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/4/2015
 * Time: 2:07 PM
 */

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', "user_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array();
        $data["page"] = "Register";
        $data["menu"] = "home";
        $data["content"] = "website/pages/public/register";

        $this->load->model("CompanyModel","company_model");
        $this->load->model("EmployeeModel","employee_model");

        $this->form_validation->set_rules('jm-register-name', 'Name', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-register-email', 'Email', 'required|valid_email|max_length[45]|callback_email_exists');
        $this->form_validation->set_rules('jm-register-password', 'Password', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-register-role', 'Role Account', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data["operation"] = "warning";
            $data["message"] = validation_errors();
            $this->load->view("website/template", $data);
        }
        else
        {
            $data = array(
                "name" => $this->input->post("jm-register-name"),
                "email" => $this->input->post("jm-register-email"),
                "password" => $this->input->post("jm-register-password"),
                "role" => $this->input->post("jm-register-role")
            );

            $result = $this->user_model->register($data);

            if($result["register"])
            {
                if(!$this->send_activation_mail($data["email"],$result["name"],$result["role"],$result["token"])){
                    $this->send_activation_mail($data["email"],$result["name"],$result["role"],$result["token"]);
                }
                $this->alert->success_alert("Your account has been registered");
                redirect("page/registered/$result[role]/$result[token]");
            }
            else
            {
                $data["operation"] = "danger";
                $data["message"] = "Something is getting wrong";
                $this->load->view("website/template", $data);
            }
        }
    }

    public function resend($role, $token)
    {
        $data = $result = $this->user_model->data_user($role, $token);
        if($data != null)
        {
            $this->send_activation_mail($data["email"],$data["name"],$role,$token);
            $this->alert->success_alert("Your account has been registered");
            redirect("page/registered/$role/$token");
        }
        else{
            redirect("page/login");
        }
    }

    public function send_activation_mail($email, $name, $role, $token)
    {
        $this->load->library('mailer');

        $mail               = new PHPMailer();

        $mail->SMTPAuth     = true;
        $mail->SMTPSecure   = "ssl";
        $mail->Host         = "smtp.gmail.com";
        $mail->Port         = 465;
        $mail->Username     = "anggadarkprince@gmail.com";
        $mail->Password     = "guardianoftime";
        $mail->Subject      = "Jagamana Registration";
        $template           = file_get_contents(base_url() . '/assets/template/registration.html');
        $template           = preg_replace('%SITEPATH%', base_url()."register/activate", $template);
        $template           = preg_replace('%NAME%', $name, $template);
        $template           = preg_replace('%ROLE%', $role, $template);
        $template           = preg_replace('%TOKEN%', $token, $template);
        $template           = preg_replace('%YEAR%', date("Y"), $template);
        $template           = preg_replace('%ADDRESS%', get_setting("Address"), $template);
        $template           = preg_replace('%WEBSITE%', get_setting("Website Name"), $template);
        $mail->Body         = $template;

        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->SetFrom('no-reply@jagamana.com', 'Jagamana Service');
        $mail->AddReplyTo("no-reply@jagamana.com","Jagamana Service");
        $mail->AddAddress($email, $name);

        if($mail->Send())
        {
            return true;
        }
        return false;
    }

    public function email_exists($email)
    {
        if ($this->user_model->check_email($email))
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('email_exists', 'The %s has been registered');
            return false;
        }
    }

    public function activate($role, $token)
    {
        $data = array();
        $data["page"] = "Activated";
        $data["menu"] = "home";
        $data["content"] = "website/pages/public/activated";
        $data["status"] = $this->user_model->activate($role, $token);
        $this->load->view("website/template", $data);
    }

}