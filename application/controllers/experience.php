<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:23 PM
 */

class Experience extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)) {
            redirect(base_url());
        }

        $this->load->library("form_validation");
    }

    public function create()
    {
        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->form_validation->set_rules('jm-experience-company', 'Experience', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-experience-position', 'Position', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-experience-description', 'Description', 'required|max_length[50]');
        $this->form_validation->set_rules('jm-experience-begin', 'Begin Year', 'required|max_length[4]');
        $this->form_validation->set_rules('jm-experience-until', 'Until Year', 'required|max_length[4]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate($employee_id);
        }
        else
        {
            $this->load->model("ExperienceModel", "experience_model");

            $data = array(
                "exp_company" => $this->input->post("jm-experience-company"),
                "exp_position" => $this->input->post("jm-experience-position"),
                "exp_description" => $this->input->post("jm-experience-description"),
                "exp_year_begin" => $this->input->post("jm-experience-begin"),
                "exp_year_until" => $this->input->post("jm-experience-until"),
                "exp_employee" => $employee_id
            );

            $result = $this->experience_model->create($data, $employee_id);

            if($result)
            {
                $this->alert->success_alert("Experience has been created successfully");
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

        $this->load->model("ExperienceModel", "experience_model");

        $result = $this->experience_model->delete($id, $employee_id);

        if($result)
        {
            $this->alert->success_alert("Experience has been removed successfully");
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