<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:25 PM
 */

class Skill extends CI_Controller
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

        $this->form_validation->set_rules('jm-skill-skill', 'Skill', 'required|max_length[30]');
        $this->form_validation->set_rules('jm-skill-description', 'Description', 'required|max_length[50]');
        $this->form_validation->set_rules('jm-skill-category', 'Category', 'required');
        $this->form_validation->set_rules('jm-skill-value', 'Level Value', 'required|greater_than[0]|less_than[6]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate($employee_id);
        }
        else
        {
            $this->load->model("SkillModel", "skill_model");

            $data = array(
                "skl_skill" => $this->input->post("jm-skill-skill"),
                "skl_description" => $this->input->post("jm-skill-description"),
                "skl_value" => $this->input->post("jm-skill-value"),
                "skl_category" => $this->input->post("jm-skill-category"),
                "skl_employee" => $employee_id
            );

            $result = $this->skill_model->create($data, $employee_id);

            if($result)
            {
                $this->alert->success_alert("Skill has been created successfully");
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

        $this->load->model("SkillModel", "skill_model");

        $result = $this->skill_model->delete($id, $employee_id);

        if($result)
        {
            $this->alert->success_alert("Skill has been removed successfully");
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