<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:15 PM
 */

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata(UserModel::$SESSION_ID) == null) {
            redirect(base_url());
        }

        $this->load->model("SettingModel","setting_model");
        $this->load->library("form_validation");
    }

    public function index()
    {
        $data = array();
        $data["page"] = "Setting";
        $data["menu"] = "setting";

        if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_COMPANY)
        {
            $data["content"] = "website/pages/company/settings";
            $data["setting"] = $this->_company();
            $this->load->view("website/template", $data);
        }
        else if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_EMPLOYEE)
        {
            $data["content"] = "website/pages/employee/settings";
            $data["setting"] = $this->_employee();
            $this->load->view("website/template", $data);
        }
        else if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_ADMINISTRATOR)
        {
            $this->load->model("AdministratorModel","administrator_model");
            $administrator = $this->session->userdata(UserModel::$SESSION_ID);
            $data["content"] = "administrator/pages/settings";
            $data["setting"] = $this->setting_model->read();
            $data["administrator"] = $this->administrator_model->read($administrator);
            $this->load->view("administrator/template", $data);
        }
        else{
            redirect("Error404");
        }
    }

    private function _employee()
    {
        $employee = $this->session->userdata(UserModel::$SESSION_ID);
        return $this->setting_model->read_employee_setting($employee);
    }

    private function _company()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);
        return $this->setting_model->read_company_setting($company);
    }

    public function update_employee()
    {
        $this->form_validation->set_rules('jm-setting-name', 'Name', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-setting-notification', 'Notification', '');
        $this->form_validation->set_rules('jm-setting-suspend', 'Suspend', '');
        $this->form_validation->set_rules('jm-password-current', 'Current Password', 'required|callback_match_password');
        $this->form_validation->set_rules('jm-password-new', 'New Password', 'max_length[45]');
        $this->form_validation->set_rules('jm-password-confirm', 'Confirm Password', 'matches[jm-password-new]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate(validation_errors());
        }
        else
        {
            $notification = 0;
            if($this->input->post("jm-setting-notification") == "on"){
                $notification = 1;
            }

            $status = "ACTIVE";
            if($this->input->post("jm-setting-suspend") == "on"){
                $status = "SUSPEND";
            }

            $data = array(
                "emp_name" => $this->input->post("jm-setting-name"),
                "emp_notification" => $notification,
                "emp_status" => $status,
                "emp_password" => $this->input->post("jm-password-new"),
            );

            $result = $this->setting_model->update_employee_setting($data);

            if(isset($result["upload"]) && !$result["upload"]){
                $this->_repopulate($result["message"]);
            }
            else if($result["query"]){
                $this->alert->success_alert("Settings has been updated successfully");
                redirect("setting");
            }
            else{
                $this->alert->danger_alert("Something is getting wrong");
                redirect("setting");
            }
        }
    }

    public function update_company()
    {
        $this->form_validation->set_rules('jm-setting-notification', 'Notification', '');
        $this->form_validation->set_rules('jm-setting-approve', 'Auto Approve', '');
        $this->form_validation->set_rules('jm-setting-suspend', 'Suspend', '');
        $this->form_validation->set_rules('jm-password-current', 'Current Password', 'required|callback_match_password');
        $this->form_validation->set_rules('jm-password-new', 'New Password', 'max_length[45]');
        $this->form_validation->set_rules('jm-password-confirm', 'Confirm Password', 'matches[jm-password-new]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate(validation_errors());
        }
        else
        {
            $notification = 0;
            if($this->input->post("jm-setting-notification") == "on"){
                $notification = 1;
            }

            $approve = 0;
            if($this->input->post("jm-setting-approve") == "on"){
                $approve = 1;
            }

            $status = "ACTIVE";
            if($this->input->post("jm-setting-suspend") == "on"){
                $status = "SUSPEND";
            }

            $data = array(
                "cmp_notification" => $notification,
                "cmp_auto_approve" => $approve,
                "cmp_status" => $status,
                "cmp_password" => $this->input->post("jm-password-new"),
            );

            $result = $this->setting_model->update_company_setting($data);

            if($result){
                $this->alert->success_alert("Settings has been updated successfully");
                redirect("setting");
            }
            else{
                $this->alert->danger_alert("Something is getting wrong");
                redirect("setting");
            }
        }
    }

    public function update_administrator()
    {
        $this->form_validation->set_rules('jm-setting-website', 'Website', 'required');
        $this->form_validation->set_rules('jm-setting-description', 'Description', 'required');
        $this->form_validation->set_rules('jm-setting-keyword', 'Keyword', 'required');
        $this->form_validation->set_rules('jm-setting-email', 'Email', 'required');
        $this->form_validation->set_rules('jm-setting-contact', 'Contact', 'required');
        $this->form_validation->set_rules('jm-setting-address', 'Address', 'required');
        $this->form_validation->set_rules('jm-setting-facebook', 'Facebook', '');
        $this->form_validation->set_rules('jm-setting-twitter', 'Twitter', '');
        $this->form_validation->set_rules('jm-setting-google', 'Google', '');

        $this->form_validation->set_rules('jm-setting-name', 'Name', 'required|max_length[50]');
        $this->form_validation->set_rules('jm-setting-about', 'About', 'required|max_length[200]');
        $this->form_validation->set_rules('jm-setting-gender', 'Gender', 'required');
        $this->form_validation->set_rules('jm-setting-current', 'Current Password', 'required|callback_match_password');
        $this->form_validation->set_rules('jm-setting-new', 'New Password', 'max_length[45]');
        $this->form_validation->set_rules('jm-setting-confirm', 'Confirm Password', 'matches[jm-setting-new]');

        if($this->form_validation->run() == FALSE)
        {
            $this->_repopulate(validation_errors());
        }
        else
        {
            $setting = array(
                "Website Name" => $this->input->post("jm-setting-website"),
                "Description" => $this->input->post("jm-setting-description"),
                "Keyword" => $this->input->post("jm-setting-keyword"),
                "Address" => $this->input->post("jm-setting-address"),
                "Email" => $this->input->post("jm-setting-email"),
                "Contact" => $this->input->post("jm-setting-contact"),
                "Facebook" => $this->input->post("jm-setting-facebook"),
                "Twitter" => $this->input->post("jm-setting-twitter"),
                "Google" => $this->input->post("jm-setting-google"),
                "Favicon" => $_FILES["jm-setting-favicon"]["name"]
            );

            $administrator = array(
                "adm_name" => $this->input->post("jm-setting-name"),
                "adm_gender" => $this->input->post("jm-setting-gender"),
                "adm_about" => $this->input->post("jm-setting-about"),
                "adm_avatar" => $_FILES["jm-setting-avatar"]["name"],
            );

            if($this->input->post("jm-setting-new") != ""){
                $administrator["adm_password"] = md5($this->input->post("jm-setting-new"));
            }

            $result = $this->setting_model->update($setting, $administrator);

            if(isset($result["upload"]) && !$result["upload"]){
                $this->_repopulate($result["message"]);
            }
            else if($result["query"]){
                $this->alert->success_alert("Settings has been updated successfully");
                redirect("setting");
            }
            else{
                $this->alert->danger_alert("Something is getting wrong");
                redirect("setting");
            }
        }
    }

    private function _repopulate($message)
    {
        $data = array();
        $data["page"] = "Setting";
        $data["menu"] = "setting";

        if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_COMPANY)
        {
            $data["setting"] = $this->_company();
            $data["operation"] = "warning";
            $data["message"] = $message;
            $data["content"] = "website/pages/company/settings";
            $this->load->view("website/template", $data);

        }
        else if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_EMPLOYEE)
        {
            $data["setting"] = $this->_employee();
            $data["operation"] = "warning";
            $data["message"] = $message;
            $data["content"] = "website/pages/employee/settings";
            $this->load->view("website/template", $data);
        }
        else if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_ADMINISTRATOR)
        {
            $this->load->model("AdministratorModel","administrator_model");
            $administrator = $this->session->userdata(UserModel::$SESSION_ID);
            $data["setting"] = $this->setting_model->read();
            $data["content"] = "administrator/pages/settings";
            $data["administrator"] = $this->administrator_model->read($administrator);
            $data["operation"] = "warning";
            $data["message"] = $message;
            $this->load->view("administrator/template", $data);
        }
        else{
            redirect("Error404");
        }

    }

    public function match_password($password)
    {
        $this->load->model("UserModel","user_model");
        if ($this->user_model->check_password($password))
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('match_password', 'The %s mismatch with your password');
            return false;
        }
    }

}