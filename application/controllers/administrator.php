<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/13/2015
 * Time: 6:26 PM
 */

class Administrator extends  CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library("form_validation");
        $this->load->model("AdministratorModel","administrator_model");
    }

    public function index()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            redirect("dashboard");
        }
        else
        {
            $data = array();
            $data["page"] = "Authentication";
            $this->load->view("administrator/pages/login", $data);
        }
    }

    public function auth()
    {
        $this->form_validation->set_rules("jm-login-username","Username","required|max_length[45]");
        $this->form_validation->set_rules('jm-login-password', 'Password', 'required|max_length[32]');

        $data = array();
        $data["page"] = "Authentication";

        if($this->form_validation->run() == FALSE)
        {
            $data["operation"] = "warning";
            $data["message"] = validation_errors();
            $this->load->view("administrator/pages/login", $data);
        }
        else{
            $username = $this->input->post("jm-login-username");
            $password = $this->input->post("jm-login-password");

            $authentication = $this->administrator_model->check_auth($username, $password);

            if($authentication == "granted")
            {
                redirect("dashboard");
            }
            else if($authentication == "mismatch")
            {
                $data["operation"] = "warning";
                $data["message"] = "Username or password mismatch";
                $this->load->view("administrator/pages/login", $data);
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
                redirect("administrator");
            }
        }
    }

    public function logout()
    {
        $this->administrator_model->destroy_auth();
        redirect("administrator");
    }

}