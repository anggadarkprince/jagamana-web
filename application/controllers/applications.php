<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:27 PM
 */

class Applications extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("ApplicationModel", "application_model");
    }

    public function index()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
        {
            $this->_employee();
        }
        else if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $this->_administrator();
        }
        else
        {
            redirect(base_url());
        }
    }

    public function approved()
    {
        $data = array();
        $data["page"] = "Application Approved";
        $data["menu"] = "application";
        $data["content"] = "administrator/pages/applications_approved";
        $data["applications"] = $this->application_model->read("ACCEPT");

        $this->load->view("administrator/template", $data);
    }

    public function rejected()
    {
        $data = array();
        $data["page"] = "Application Rejected";
        $data["menu"] = "application";
        $data["content"] = "administrator/pages/applications_rejected";
        $data["applications"] = $this->application_model->read("REJECT");

        $this->load->view("administrator/template", $data);
    }

    public function statistic()
    {
        $data = array();
        $data["page"] = "Application Statistic";
        $data["menu"] = "application";
        $data["content"] = "administrator/pages/applications_statistic";
        $data["applications"] = $this->application_model->get_daily_statistic();

        $this->load->view("administrator/template", $data);
    }

    private function _employee()
    {
        $employee = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Application";
        $data["menu"] = "application";
        $data["content"] = "website/pages/employee/applications";
        $data["applications"] = $this->application_model->read_by_employee($employee);

        $this->load->view("website/template", $data);
    }

    private function _administrator()
    {
        $this->session->unset_userdata("jm_new_application");

        $data = array();
        $data["page"] = "Application";
        $data["menu"] = "application";
        $data["content"] = "administrator/pages/applications";
        $data["applications"] = $this->application_model->read("PENDING");

        $this->load->view("administrator/template", $data);
    }

    public function resume($id)
    {
        $this->load->model("ResumePrinter", "resume_printer");
        $this->resume_printer->generate_resume($id);
    }

    public function confirm($id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $result = $this->application_model->accept_application($id);

            if($result)
            {
                $this->alert->success_alert("Application has been accepted successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("applications");
        }
        else
        {
            redirect("show404");
        }
    }

    public function discard($id, $destination = null)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $result = $this->application_model->discard_application($id);

            if($result)
            {
                $this->alert->warning_alert("Application has been discarded successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("applications/$destination");
        }
        else
        {
            redirect("show404");
        }
    }

    public function reject($id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $result = $this->application_model->reject_application($id);

            if($result)
            {
                $this->alert->warning_alert("Application has been rejected successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("applications");
        }
        else
        {
            redirect("show404");
        }
    }

    public function delete($id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $result = $this->application_model->delete($id);

            if($result)
            {
                $this->alert->warning_alert("Application has been deleted successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("applications");
        }
        else
        {
            redirect("show404");
        }
    }

}