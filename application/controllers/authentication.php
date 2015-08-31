<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 5:33 PM
 */

class Authentication extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("UserModel","user_model");
        $this->load->library('form_validation');
    }

    public function login()
    {
        $data               = array();
        $data["page"]       = "Login";
        $data["menu"]       = "home";
        $data["content"]    = "website/pages/public/login";

        $this->form_validation->set_rules('jm-login-email', 'Email', 'required|valid_email|max_length[45]');
        $this->form_validation->set_rules('jm-login-password', 'Password', 'required|max_length[45]');

        if ($this->form_validation->run() == FALSE)
        {
            $data["operation"]  = "warning";
            $data["message"]    = validation_errors();
            $this->load->view("website/template", $data);
        }
        else
        {
            $email      = $this->input->post("jm-login-email");
            $password   = $this->input->post("jm-login-password");

            $result = $this->user_model->authentication($email, $password);

            if($result["login"])
            {
                if($result["status"] == "ACTIVE" || $result["status"] == "SUSPEND"){
                    redirect("dashboard");
                    return;
                }
                else if($result["status"] == "PENDING"){
                    $data["operation"]  = "warning";
                    $data["message"]    = "Please activate account,<br><a href='".site_url()."register/resend/".$result["role"]."/".$result["token"]."'>click here</a> to resend email acitvation";
                }
                else{
                    $data["operation"]  = "danger";
                    $data["message"]    = "Something is getting wrong";
                }
                $this->load->view("website/template", $data);
            }
            else
            {
                $data["operation"]  = "warning";
                $data["message"] = "Username or Password Mismatch";
                $this->load->view("website/template", $data);
            }
        }
    }

    public function logout()
    {
        $this->user_model->destroy();
        redirect(base_url());
    }

    public function forgot()
    {
        $email = $this->input->post("jm-forgot-email");

        $result = $this->user_model->check_email($email, true);

        if($result["registered"])
        {
            $this->send_forgot_mail($result["email"],$result["name"],$result["role"],$result["token"]);
            redirect("page/forgot/$result[role]/$result[token]");
        }
        else
        {
            $data               = array();
            $data["page"]       = "Login";
            $data["menu"]       = "home";
            $data["content"]    = "website/pages/public/login";
            $data["operation"]  = "danger";
            $data["message"]    = "Your email doesn't registered";
            $this->load->view("website/template", $data);
        }
    }

    public function send_forgot_mail($email, $name, $role, $token)
    {
        $this->load->library('mailer');

        $mail               = new PHPMailer();

        $mail->SMTPAuth     = true;
        $mail->SMTPSecure   = "ssl";
        $mail->Host         = "smtp.gmail.com";
        $mail->Port         = 465;
        $mail->Username     = "jagamana.service@gmail.com";
        $mail->Password     = "jagamana1234";
        $mail->Subject      = "Jagamana Reset Password";
        $template           = file_get_contents(base_url() . '/assets/template/forgot.html');
        $template           = preg_replace('%SITEPATH%', base_url()."page/recovery", $template);
        $template           = preg_replace('%NAME%', $name, $template);
        $template           = preg_replace('%ROLE%', $role, $template);
        $template           = preg_replace('%TOKEN%', $token, $template);
        $template           = preg_replace('%YEAR%', date("Y"), $template);
        $template           = preg_replace('%ADDRESS%', get_setting("Address"), $template);
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

    public function reset()
    {
        $data               = array();
        $data["page"]       = "Recovery";
        $data["content"]    = "website/pages/public/recovery";

        $this->form_validation->set_rules('jm-reset-email', 'Email', 'required');
        $this->form_validation->set_rules('jm-reset-token', 'Token', 'required');
        $this->form_validation->set_rules('jm-reset-password', 'Password', 'required|matches[jm-reset-confirm]');
        $this->form_validation->set_rules('jm-reset-confirm', 'Password Confirmation', 'required');

        if(!$this->form_validation->run())
        {
            $data["operation"]  = "warning";
            $data["message"]    = validation_errors();
        }
        else
        {
            $email = $this->input->post("jm-reset-email");
            $token = $this->input->post("jm-reset-token");
            $role = $this->input->post("jm-reset-role");
            $password = $this->input->post("jm-reset-password");

            $result = $this->user_model->reset_password($role, $email, $token, $password);

            if($result)
            {
                redirect("page/recovered");
            }
            else{
                $account = $this->user_model->data_user($role, $token);
                $data["operation"]  = "danger";
                $data["message"]    = "Something is getting wrong";
                $data["account"]    = $account;
            }
        }

        $this->load->view("website/template", $data);
    }

}