<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/7/2015
 * Time: 8:47 AM
 */

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
        {
            $this->load->model("EmployeeActivityModel", "activity_model");
            $this->load->model("ApplicationModel", "application_model");
            $this->load->model("BookmarkModel", "bookmark_model");
            $this->load->model("FollowerModel", "follower_model");
            $employee = $this->session->userdata(UserModel::$SESSION_ID);

            $data = array();
            $data["page"] = "Employee Dashboard";
            $data["menu"] = "dashboard";
            $data["content"] = "website/pages/employee/dashboard";
            $data["chart"] = $this->application_model->get_statistic_range_applied($employee);
            $data["statistic_applied"] = $this->application_model->get_statistic_applied($employee);
            $data["statistic_saved"] = $this->bookmark_model->get_statistic_saved($employee);
            $data["statistic_following"] = $this->follower_model->get_statistic_following($employee);
            $data["activities"] = $this->activity_model->read_by_activity($employee);

            $this->load->view("website/template", $data);
        }
        else if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            $this->load->model("CompanyActivityModel", "activity_model");
            $this->load->model("ApplicationModel", "application_model");
            $this->load->model("JobModel", "job_model");
            $this->load->model("FollowerModel", "follower_model");
            $company = $this->session->userdata(UserModel::$SESSION_ID);

            $data = array();
            $data["page"] = "Company Dashboard";
            $data["menu"] = "dashboard";
            $data["content"] = "website/pages/company/dashboard";
            $data["chart"] = $this->application_model->get_statistic_range_applicant($company);
            $data["statistic_applicant"] = $this->application_model->get_statistic_applicant($company);
            $data["statistic_job"] = $this->job_model->get_statistic_list($company);
            $data["statistic_follower"] = $this->follower_model->get_statistic_follower($company);
            $data["activities"] = $this->activity_model->read_by_activity($company);

            $this->load->view("website/template", $data);
        }
        else if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $this->load->model("VisitorModel", "visitor_model");

            $data = array();
            $data["page"] = "Dashboard";
            $data["menu"] = "dashboard";
            $data["content"] = "administrator/pages/dashboard";
            $data["visitor"] = $this->visitor_model->read_chart_statistic();

            $this->load->view("administrator/template", $data);
        }
        else
        {
            redirect(base_url());
        }
    }

}