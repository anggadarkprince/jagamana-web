<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/17/2015
 * Time: 6:49 PM
 */

class Account extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("EmployeeModel", "employee_model");
        $this->load->model("EducationModel", "education_model");
        $this->load->model("ExperienceModel", "experience_model");
        $this->load->model("SkillModel", "skill_model");
        $this->load->model("SkillCategoryModel", "skill_category_model");
        $this->load->model("PortfolioModel", "portfolio_model");
        $this->load->model("FollowerModel", "follower_model");
        $this->load->model("ThreadModel","thread_model");
    }

    public function detail($permalink)
    {
        $employee_id = permalink_id($permalink);

        $data = array();
        $data["content"] = "website/pages/public/account";
        $data["employee"] = $this->employee_model->read($employee_id);
        $data["page"] = $data["employee"]["emp_name"];
        $data["educations"] = $this->education_model->read_by_employee($employee_id);
        $data["experiences"] = $this->experience_model->read_by_employee($employee_id);
        $data["skills"] = $this->skill_model->read_by_employee($employee_id);
        $data["skill_categories"] = $this->skill_category_model->read();
        $data["portfolios"] = $this->portfolio_model->read_by_employee($employee_id);

        $this->load->view("website/template", $data);
    }

    public function following($permalink)
    {
        $employee_id = permalink_id($permalink);

        $data = array();
        $data["content"] = "website/pages/public/account_following";
        $data["employee"] = $this->employee_model->read($employee_id);
        $data["page"] = $data["employee"]["emp_name"];
        $data["following"] = $this->follower_model->read_by_employee($employee_id);
        $this->load->view("website/template", $data);
    }

    public function thread($permalink)
    {
        $employee_id = permalink_id($permalink);

        $data = array();
        $data["content"] = "website/pages/public/account_thread";
        $data["employee"] = $this->employee_model->read($employee_id);
        $data["page"] = $data["employee"]["emp_name"];
        $data["threads"] = $this->thread_model->read_by_author(null, null, $employee_id);
        $this->load->view("website/template", $data);
    }

}