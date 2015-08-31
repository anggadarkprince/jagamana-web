<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:39 PM
 */

class Employee extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR)) {
            redirect(base_url());
        }

        $this->load->model("EmployeeModel", "employee_model");
    }

    public function index()
    {
        $this->session->unset_userdata("jm_new_employee");

        $data = array();
        $data["page"] = "Employee";
        $data["menu"] = "employee";
        $data["content"] = "administrator/pages/employees";
        $data["employees"] = $this->employee_model->read_all();

        $this->load->view("administrator/template",$data);
    }

    public function suspended()
    {
        $data = array();
        $data["page"] = "Employee";
        $data["menu"] = "employee";
        $data["content"] = "administrator/pages/employees_suspended";
        $data["employees"] = $this->employee_model->read_suspended();

        $this->load->view("administrator/template",$data);
    }


    public function suspend($id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $id = permalink_id($id);

            $result = $this->employee_model->suspending($id);

            if($result)
            {
                $this->alert->warning_alert("Employee has been suspended successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("employee");
        }
        else
        {
            redirect("show404");
        }
    }

    public function activate($id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $id = permalink_id($id);

            $result = $this->employee_model->activating($id);

            if($result)
            {
                $this->alert->success_alert("Employee has been activated successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("employee/suspended");
        }
        else
        {
            redirect("show404");
        }
    }

    public function detail()
    {

    }

    public function delete($id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $result = $this->employee_model->delete($id);

            if($result)
            {
                $this->alert->warning_alert("Employee has been deleted successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("employee");
        }
        else
        {
            redirect("show404");
        }
    }


}