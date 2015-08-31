<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:18 PM
 */

class Resume extends CI_Controller
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
        $this->load->model("EmployeeModel", "employee_model");

        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Resume";
        $data["menu"] = "resume";
        $data["content"] = "website/pages/employee/resumes";
        $data["resume"] = $this->employee_model->read($employee_id);

        $this->load->view("website/template", $data);
    }

    public function standard()
    {
        $this->load->model("EmployeeModel", "employee_model");
        $this->load->model("EducationModel", "education_model");
        $this->load->model("ExperienceModel", "experience_model");
        $this->load->model("SkillModel", "skill_model");
        $this->load->model("SkillCategoryModel", "skill_category_model");
        $this->load->model("PortfolioModel", "portfolio_model");

        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Resume";
        $data["menu"] = "resume";
        $data["content"] = "website/pages/employee/resumes_standard";
        $data["employee"] = $this->employee_model->read($employee_id);
        $data["educations"] = $this->education_model->read_by_employee($employee_id);
        $data["experiences"] = $this->experience_model->read_by_employee($employee_id);
        $data["skills"] = $this->skill_model->read_by_employee($employee_id);
        $data["skill_categories"] = $this->skill_category_model->read();
        $data["portfolios"] = $this->portfolio_model->read_by_employee($employee_id);

        $this->load->view("website/template", $data);
    }

    public function upload()
    {
        $this->load->model("EmployeeModel", "employee_model");
        $this->load->model("UploaderModel", "uploader_model");

        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $config = array(
            "allowed_types" => UploaderModel::$TYPE_DOCUMENT,
            "upload_path" => "./assets/data",
            "file_name" => "resume-".$this->session->userdata(UserModel::$SESSION_NAME)."-".substr($this->session->userdata(UserModel::$SESSION_ID),0,5),
            "overwrite" => TRUE,
            "input_source" => "jm-resume-file"
        );
        $this->uploader_model->config($config);

        $upload = $this->uploader_model->start_upload();

        if($upload)
        {
            $data = array("emp_resume" => $this->uploader_model->upload_data()["file_name"]);

            $result = $this->employee_model->update($data, $employee_id);

            if($result){
                $this->alert->success_alert("File Resume has been uploaded");
            }
            else {
                $this->alert->danger_alert("Something is getting wrong");
            }
        }
        else
        {
            $this->alert->warning_alert($this->uploader_model->upload_error());
        }

        redirect("resume");
    }

    public function generate()
    {
        $this->load->model("ResumePrinter", "resume_printer");
        $this->resume_printer->generate_resume();
    }

    public function update_detail()
    {
        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->form_validation->set_rules('jm-resume-name', 'Name', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-resume-gender', 'Gender', 'required');
        $this->form_validation->set_rules('jm-resume-birthday', 'Birthday', 'required');
        $this->form_validation->set_rules('jm-resume-nationality', 'Nationality', 'required|max_length[100]');
        $this->form_validation->set_rules('jm-resume-address', 'Address', 'required|max_length[100]');
        $this->form_validation->set_rules('jm-resume-contact', 'Contact', 'required|max_length[100]');
        $this->form_validation->set_rules('jm-resume-website', 'Website', 'required|max_length[100]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate($employee_id);
        }
        else{
            $this->load->model("EmployeeModel", "employee_model");

            $data = array(
                "emp_name" => $this->input->post("jm-resume-name"),
                "emp_gender" => $this->input->post("jm-resume-gender"),
                "emp_birthday" => date_format(date_create($this->input->post("jm-resume-birthday")),"Y-m-d"),
                "emp_nationality" => $this->input->post("jm-resume-nationality"),
                "emp_address" => $this->input->post("jm-resume-address"),
                "emp_contact" => $this->input->post("jm-resume-contact"),
                "emp_website" => $this->input->post("jm-resume-website"),
            );

            $result = $this->employee_model->update($data, $employee_id);

            if($result)
            {
                $this->alert->success_alert("Profile has been updated successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("resume/standard");
        }
    }

    public function update_profile()
    {
        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->form_validation->set_rules('jm-resume-about', 'About', 'required|max_length[2000]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate($employee_id);
        }
        else
        {
            $this->load->model("EmployeeModel", "employee_model");

            $data = array("emp_about" => $this->input->post("jm-resume-about"));

            $result = $this->employee_model->update($data, $employee_id);

            if($result)
            {
                $this->alert->success_alert("Profile has been updated successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("resume/standard");
        }
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
        $data["menu"] = "resume";
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