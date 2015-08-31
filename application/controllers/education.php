<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:21 PM
 */

class Education extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)) {
            redirect(base_url());
        }

        $this->load->library("form_validation");
    }

    public function index()
    {

    }

    public function create()
    {
        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->form_validation->set_rules('jm-education-grade', 'Grade', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-education-institution', 'Institution', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-education-location', 'Location', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-education-begin', 'Begin Year', 'required|max_length[4]');
        $this->form_validation->set_rules('jm-education-until', 'Until Year', 'required|max_length[4]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate($employee_id);
        }
        else
        {
            $this->load->model("EducationModel", "education_model");

            $data = array(
                "edc_education" => $this->input->post("jm-education-grade"),
                "edc_institution" => $this->input->post("jm-education-institution"),
                "edc_location" => $this->input->post("jm-education-location"),
                "edc_year_begin" => $this->input->post("jm-education-begin"),
                "edc_year_until" => $this->input->post("jm-education-until"),
                "edc_employee" => $employee_id
            );

            $result = $this->education_model->create($data, $employee_id);

            if($result)
            {
                $this->alert->success_alert("Education has been created successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("resume/standard");
        }
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete($id)
    {
        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->load->model("EducationModel", "education_model");

        $result = $this->education_model->delete($id, $employee_id);

        if($result)
        {
            $this->alert->success_alert("Education has been removed successfully");
        }
        else
        {
            $this->alert->danger_alert("Something is getting wrong");
        }

        redirect("resume/standard");
    }

    private function _repopulate($employee_id)
    {
        $this->load->model("EmployeeModel", "employee_model");
        $this->load->model("EducationModel", "education_model");
        $this->load->model("ExperienceModel", "experience_model");
        $this->load->model("SkillModel", "skill_model");
        $this->load->model("SkillCategoryModel", "skill_category_model");
        $this->load->model("PortfolioModel", "portfolio_model");

        $data = array();
        $data["page"] = "Resume";
        $data["content"] = "website/pages/employee/resumes_standard";
        $data["employee"] = $this->employee_model->read($employee_id);
        $data["educations"] = $this->education_model->read_by_employee($employee_id);
        $data["experiences"] = $this->experience_model->read_by_employee($employee_id);
        $data["skills"] = $this->skill_model->read_by_employee($employee_id);
        $data["skill_categories"] = $this->skill_category_model->read();
        $data["portfolios"] = $this->portfolio_model->read_by_employee($employee_id);
        $data["operation"] = "warning";
        $data["message"] = validation_errors();

        $this->load->view("website/template", $data);
    }

}