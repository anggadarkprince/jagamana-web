<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:14 PM
 */

class Notification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE) && !UserModel::is_authorize(UserModel::$TYPE_COMPANY)) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $notification = array();
        $data = array();
        $data["page"] = "Notifications";
        $data["menu"] = "notification";

        if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_COMPANY)
        {
            $data["content"] = "website/pages/company/notifications";
            $notification = $this->company();
        }
        else if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_EMPLOYEE)
        {
            $data["content"] = "website/pages/employee/notifications";
            $notification = $this->employee();
        }
        else{
            redirect("Error404");
        }

        $data["notifications"] = $notification;

        $this->load->view("website/template", $data);
    }

    private function employee()
    {
        $this->load->model("EmployeeActivityModel", "notification_model");
        $employee = $this->session->userdata(UserModel::$SESSION_ID);
        return $this->notification_model->read_by_notification($employee);
    }

    private function company()
    {
        $this->load->model("CompanyActivityModel", "notification_model");
        $company = $this->session->userdata(UserModel::$SESSION_ID);
        return $this->notification_model->read_by_notification($company);
    }

}