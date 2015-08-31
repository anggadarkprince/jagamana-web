<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/25/2015
 * Time: 9:13 PM
 */

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_COMPANY)) {
            redirect(base_url());
        }

        $this->load->model("CompanyModel","company_model");
        $this->load->model("CompanyFieldModel","company_field_model");
        $this->load->model("CompanySizeModel", "company_size_model");
        $this->load->model("CountryModel", "country_model");
        $this->load->model("StateModel", "state_model");
        $this->load->model("CityModel", "city_model");
        $this->load->model("UploaderModel", "uploader_model");
        $this->load->model("CompanySectionModel", "section_model");
        $this->load->model("CompanyTaskModel", "task_model");
        $this->load->model("AchievementModel", "achievement_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->about();
    }

    public function about()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Profile About";
        $data["menu"] = "profile";
        $data["content"] = "website/pages/company/profile_about";
        $data["about"] = $this->company_model->read_by_id($company);
        $data["fields"] = $this->company_field_model->read();
        $data["sizes"] = $this->company_size_model->read();
        $data["cities"] = $this->city_model->read_by_state($data["about"]["state_id"]);
        $data["states"] = $this->state_model->read_by_country($data["about"]["country_id"]);
        $data["countries"] = $this->country_model->read();

        $this->load->view("website/template", $data);
    }

    public function update_about()
    {
        $this->form_validation->set_rules('jm-profile-company', 'Company Name', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-profile-field', 'Company Field', 'required');
        $this->form_validation->set_rules('jm-profile-size', 'Company Size', '');
        $this->form_validation->set_rules('jm-profile-location-country', 'Country Location', 'required');
        $this->form_validation->set_rules('jm-profile-location-province', 'Province Location', 'required');
        $this->form_validation->set_rules('jm-profile-location-city', 'City Location', 'required');
        $this->form_validation->set_rules('jm-profile-description', 'Description', 'required|max_length[350]');
        $this->form_validation->set_rules('jm-profile-contact', 'Contact', 'required|max_length[100]');
        $this->form_validation->set_rules('jm-profile-address', 'Address', 'required|max_length[200]');

        $company = $this->session->userdata(UserModel::$SESSION_ID);

        if($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data["page"] = "Profile About";
            $data["menu"] = "profile";
            $data["content"] = "website/pages/company/profile_about";
            $data["about"] = $this->company_model->read_by_id($company);
            $data["fields"] = $this->company_field_model->read();
            $data["sizes"] = $this->company_size_model->read();
            $data["cities"] = $this->city_model->read_by_state($data["about"]["state_id"]);
            $data["states"] = $this->state_model->read_by_country($data["about"]["country_id"]);
            $data["countries"] = $this->country_model->read();
            $data["operation"] = "warning";
            $data["message"] = validation_errors();

            $this->load->view("website/template", $data);
        }
        else
        {
            $data = array(
                "cmp_name" => $this->input->post("jm-profile-company"),
                "cmp_description" => $this->input->post("jm-profile-description"),
                "cmp_field" => $this->input->post("jm-profile-field"),
                "cmp_size" => $this->input->post("jm-profile-size"),
                "cmp_location" => $this->input->post("jm-profile-location-city"),
                "cmp_contact" => $this->input->post("jm-profile-contact"),
                "cmp_address" => $this->input->post("jm-profile-address"),
                "cmp_website" => $this->input->post("jm-profile-website"),
            );

            $upload = true;

            if($_FILES["jm-profile-logo"]["size"] != 0 && $_FILES["jm-profile-logo"]["name"] != "")
            {
                $config = array(
                    "allowed_types" => UploaderModel::$TYPE_IMAGE,
                    "upload_path" => "./assets/img/avatar",
                    "file_name" => $this->session->userdata(UserModel::$SESSION_ID),
                    "overwrite" => TRUE,
                    "input_source" => "jm-profile-logo",
                    "max_width" => 2000,
                    "max_height" => 2000
                );
                $this->uploader_model->config($config);

                $upload = $this->uploader_model->start_upload();

                if($upload)
                {
                    $data["cmp_logo"] = $this->uploader_model->upload_data()["file_name"];
                }
                else
                {
                    $this->alert->warning_alert($this->uploader_model->upload_error());
                }
            }

            $result = $this->company_model->update($data, $company);

            if($result && $upload)
            {
                $this->session->set_userdata(UserModel::$SESSION_NAME, $data["cmp_name"]);
                $this->alert->success_alert("Company Profile has been updated successfully");
            }
            else if(!$result)
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("profile/about");
        }
    }

    public function story()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Profile Story";
        $data["menu"] = "profile";
        $data["content"] = "website/pages/company/profile_story";
        $data["who"] = $this->section_model->read(1, $company);
        $data["culture"] = $this->section_model->read(2, $company);

        $this->load->view("website/template", $data);
    }

    public function update_story()
    {
        $this->form_validation->set_rules('jm-who-we', 'Who You Are', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-who-description', 'Who We Are Description', 'required|max_length[2000]');
        $this->form_validation->set_rules('jm-who-status', 'Who We Are Status', '');
        $this->form_validation->set_rules('jm-culture-title', 'Company Name', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-culture-description', 'Culture Description', 'required|max_length[2000]');
        $this->form_validation->set_rules('jm-culture-status', 'Culture Status', '');

        $company = $this->session->userdata(UserModel::$SESSION_ID);

        if($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data["page"] = "Profile Story";
            $data["menu"] = "profile";
            $data["content"] = "website/pages/company/profile_story";
            $data["who"] = $this->section_model->read(1, $company);
            $data["culture"] = $this->section_model->read(2, $company);
            $data["operation"] = "warning";
            $data["message"] = validation_errors();

            $this->load->view("website/template", $data);
        }
        else
        {
            $data_culture = array(
                "cst_title" => $this->input->post("jm-culture-title"),
                "cst_description" => $this->input->post("jm-culture-description"),
                "cst_active" => $this->input->post("jm-culture-status")
            );

            $data_who = array(
                "cst_title" => $this->input->post("jm-who-we"),
                "cst_description" => $this->input->post("jm-who-description"),
                "cst_active" => $this->input->post("jm-who-status")
            );

            $upload = true;

            $config = array(
                "allowed_types" => UploaderModel::$TYPE_IMAGE,
                "upload_path" => "./assets/img/office",
                "file_name" => $this->session->userdata(UserModel::$SESSION_ID),
                "overwrite" => TRUE,
                "max_width" => 2000,
                "max_height" => 2000
            );

            if($_FILES["jm-who-featured"]["size"] != 0 && $_FILES["jm-who-featured"]["name"] != "")
            {
                $config["input_source"] = "jm-who-featured";
                $config["file_name"] = "who-".$this->session->userdata(UserModel::$SESSION_ID);
                $uploader = new UploaderModel();
                $uploader->config($config);
                $upload = $uploader->start_upload();

                if($upload)
                {
                    $data_who["cst_featured"] = $config["file_name"].$uploader->upload_data()["file_ext"];
                }
                else
                {
                    $this->alert->warning_alert($uploader->upload_error());
                }
            }

            $result_who = $this->section_model->update($data_who, 1, $company);

            if($_FILES["jm-culture-featured"]["size"] != 0 && $_FILES["jm-culture-featured"]["name"] != "")
            {
                $config["input_source"] = "jm-culture-featured";
                $config["file_name"] = "culture-".$this->session->userdata(UserModel::$SESSION_ID);
                $uploader = new UploaderModel();
                $uploader->config($config);
                $upload = $uploader->start_upload();

                if($upload)
                {
                    $data_culture["cst_featured"] = $config["file_name"].$uploader->upload_data()["file_ext"];
                }
                else
                {
                    $this->alert->warning_alert($uploader->upload_error());
                }
            }

            $result_culture = $this->section_model->update($data_culture, 2, $company);

            if($result_who && $result_culture && $upload)
            {
                $this->alert->success_alert("Company story has been updated successfully");
            }
            else if(!$result_who || !$result_culture)
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("profile/story");
        }
    }

    public function task()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Profile Task";
        $data["menu"] = "profile";
        $data["content"] = "website/pages/company/profile_task";
        $data["tasks"] = $this->task_model->read_by_company($company);

        $this->load->view("website/template", $data);
    }

    public function opinion()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Profile Opinion";
        $data["menu"] = "profile";
        $data["content"] = "website/pages/company/profile_opinion";
        $data["expectation"] = $this->section_model->read(3, $company);
        $data["opinion"] = $this->section_model->read(4, $company);

        $this->load->view("website/template", $data);
    }

    public function update_opinion()
    {
        $this->form_validation->set_rules('jm-expectation-expecting', 'Expectation', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-expectation-description', 'Expectation Description', 'required|max_length[2000]');
        $this->form_validation->set_rules('jm-expectation-status', 'Expectation Status', '');
        $this->form_validation->set_rules('jm-opinion-feeling', 'Opinion', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-opinion-description', 'Opinion Description', 'required|max_length[2000]');
        $this->form_validation->set_rules('jm-opinion-status', 'Opinion Status', '');

        $company = $this->session->userdata(UserModel::$SESSION_ID);

        if($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data["page"] = "Profile Opinion";
            $data["menu"] = "profile";
            $data["content"] = "website/pages/company/profile_opinion";
            $data["expectation"] = $this->section_model->read(3, $company);
            $data["opinion"] = $this->section_model->read(4, $company);
            $data["operation"] = "warning";
            $data["message"] = validation_errors();

            $this->load->view("website/template", $data);
        }
        else
        {
            $data_expectation = array(
                "cst_title" => $this->input->post("jm-expectation-expecting"),
                "cst_description" => $this->input->post("jm-expectation-description"),
                "cst_active" => $this->input->post("jm-expectation-status")
            );

            $data_opinion = array(
                "cst_title" => $this->input->post("jm-opinion-feeling"),
                "cst_description" => $this->input->post("jm-opinion-description"),
                "cst_active" => $this->input->post("jm-opinion-status")
            );

            $upload = true;

            $config = array(
                "allowed_types" => UploaderModel::$TYPE_IMAGE,
                "upload_path" => "./assets/img/office",
                "file_name" => $this->session->userdata(UserModel::$SESSION_ID),
                "overwrite" => TRUE,
                "max_width" => 2000,
                "max_height" => 2000
            );

            if($_FILES["jm-expectation-featured"]["size"] != 0 && $_FILES["jm-expectation-featured"]["name"] != "")
            {
                $config["input_source"] = "jm-expectation-featured";
                $config["file_name"] = "expectation-".$this->session->userdata(UserModel::$SESSION_ID);
                $uploader = new UploaderModel();
                $uploader->config($config);
                $upload = $uploader->start_upload();

                if($upload)
                {
                    $data_expectation["cst_featured"] = $config["file_name"].$uploader->upload_data()["file_ext"];
                }
                else
                {
                    $this->alert->warning_alert($uploader->upload_error());
                }
            }

            $result_expectation = $this->section_model->update($data_expectation, 3, $company);

            if($_FILES["jm-opinion-featured"]["size"] != 0 && $_FILES["jm-opinion-featured"]["name"] != "")
            {
                $config["input_source"] = "jm-opinion-featured";
                $config["file_name"] = "opinion-".$this->session->userdata(UserModel::$SESSION_ID);
                $uploader = new UploaderModel();
                $uploader->config($config);
                $upload = $uploader->start_upload();

                if($upload)
                {
                    $data_opinion["cst_featured"] = $config["file_name"].$uploader->upload_data()["file_ext"];
                }
                else
                {
                    $this->alert->warning_alert($uploader->upload_error());
                }
            }

            $result_opinion = $this->section_model->update($data_opinion, 4, $company);

            if($result_expectation && $result_opinion && $upload)
            {
                $this->alert->success_alert("Company opinion has been updated successfully");
            }
            else if(!$result_expectation || !$result_opinion)
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("profile/opinion");
        }
    }

    public function achievement()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Profile Task";
        $data["menu"] = "profile";
        $data["content"] = "website/pages/company/profile_achievement";
        $data["achievements"] = $this->achievement_model->read_by_company($company);

        $this->load->view("website/template", $data);
    }

}