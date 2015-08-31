<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:46 PM
 */

class People extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_COMPANY)) {
            redirect(base_url());
        }

        $this->load->model("PeopleModel","people_model");
        $this->load->model("PeoplePhotoModel","people_photo_model");
        $this->load->model("PeopleSectionModel", "section_model");
        $this->load->model("UploaderModel", "uploader_model");

        $this->load->library('form_validation');
    }

    public function index()
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "People";
        $data["menu"] = "people";
        $data["content"] = "website/pages/company/people";
        $data["people"] = $this->people_model->read_by_company($company_id);

        $this->load->view("website/template", $data);
    }

    public function create()
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->form_validation->set_rules('jm-people-name', 'Name', 'required|max_length[50]');
        $this->form_validation->set_rules('jm-people-position', 'Position', 'required|max_length[50]');
        $this->form_validation->set_rules('jm-people-about', 'About', 'required|max_length[500]');

        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data["page"] = "People";
            $data["menu"] = "people";
            $data["content"] = "website/pages/company/people";
            $data["people"] = $this->people_model->read_by_company($company_id);
            $data["operation"] = "warning";
            $data["message"] = validation_errors();

            $this->load->view("website/template", $data);
        }
        else
        {
            $data = array(
                "plp_name" => $this->input->post("jm-people-name"),
                "plp_position" => $this->input->post("jm-people-position"),
                "plp_about" => $this->input->post("jm-people-about"),
                "plp_company" => $company_id
            );

            $upload = true;

            if($_FILES["jm-people-avatar"]["size"] != 0 && $_FILES["jm-people-avatar"]["name"] != "")
            {
                $config = array(
                    "allowed_types" => UploaderModel::$TYPE_IMAGE,
                    "upload_path" => "./assets/img/people",
                    "file_name" => "people-avatar".$this->session->userdata(UserModel::$SESSION_NAME)."-".uniqid(),
                    "overwrite" => FALSE,
                    "input_source" => "jm-people-avatar",
                    "max_width" => 2000,
                    "max_height" => 2000
                );
                $this->uploader_model->config($config);

                $upload = $this->uploader_model->start_upload();

                if($upload)
                {
                    $data["plp_avatar"] = $this->uploader_model->upload_data()["file_name"];
                }
                else
                {
                    $this->alert->warning_alert($this->uploader_model->upload_error());
                }
            }

            $result = $this->people_model->create($data);

            if($result["status"] && $upload)
            {
                $this->alert->success_alert("People has been created successfully");
                redirect("people/profile/".permalink($data["plp_name"],$result["id"]));
            }
            else if(!$result["status"])
            {
                $this->alert->danger_alert("Something is getting wrong");
                redirect("people");
            }
        }
    }

    public function profile($permalink)
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $people_id = permalink_id($permalink);

        $data = array();
        $data["page"] = "People Profile";
        $data["menu"] = "people";
        $data["content"] = "website/pages/company/people_profile";
        $data["people"] = $this->people_model->read($people_id, $company_id);

        $this->load->view("website/template", $data);
    }

    public function update_profile($permalink)
    {
        $this->form_validation->set_rules('jm-people-name', 'Name', 'required|max_length[50]');
        $this->form_validation->set_rules('jm-people-position', 'Position', 'required|max_length[50]');
        $this->form_validation->set_rules('jm-people-about', 'About', 'required|max_length[500]');
        $this->form_validation->set_rules('jm-people-opinion', 'Opinion', 'required|max_length[300]');

        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $people_id = permalink_id($permalink);

        if($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data["page"] = "People Profile";
            $data["menu"] = "people";
            $data["content"] = "website/pages/company/people_profile";
            $data["people"] = $this->people_model->read($people_id, $company_id);
            $data["operation"] = "warning";
            $data["message"] = validation_errors();

            $this->load->view("website/template", $data);
        }
        else
        {
            $data = array(
                "plp_name" => $this->input->post("jm-people-name"),
                "plp_position" => $this->input->post("jm-people-position"),
                "plp_about" => $this->input->post("jm-people-about"),
                "plp_caption" => $this->input->post("jm-people-opinion"),
            );

            $upload = true;

            if($_FILES["jm-people-avatar"]["size"] != 0 && $_FILES["jm-people-avatar"]["name"] != "")
            {
                $config = array(
                    "allowed_types" => UploaderModel::$TYPE_IMAGE,
                    "upload_path" => "./assets/img/people",
                    "file_name" => "people-".$this->session->userdata(UserModel::$SESSION_NAME)."-".$people_id,
                    "overwrite" => TRUE,
                    "input_source" => "jm-people-avatar",
                    "max_width" => 2000,
                    "max_height" => 2000
                );
                $this->uploader_model->config($config);

                $upload = $this->uploader_model->start_upload();

                if($upload)
                {
                    $data["plp_avatar"] = $this->uploader_model->upload_data()["file_name"];
                }
                else
                {
                    $this->alert->warning_alert($this->uploader_model->upload_error());
                }
            }

            if($_FILES["jm-people-cover"]["size"] != 0 && $_FILES["jm-people-cover"]["name"] != "")
            {
                $config = array(
                    "allowed_types" => UploaderModel::$TYPE_IMAGE,
                    "upload_path" => "./assets/img/people",
                    "file_name" => "people-cover-".$this->session->userdata(UserModel::$SESSION_NAME)."-".$people_id,
                    "overwrite" => TRUE,
                    "input_source" => "jm-people-cover",
                    "max_width" => 2000,
                    "max_height" => 2000
                );
                $this->uploader_model->config($config);

                $upload = $this->uploader_model->start_upload();

                if($upload)
                {
                    $data["plp_cover"] = $this->uploader_model->upload_data()["file_name"];
                }
                else
                {
                    $this->alert->warning_alert($this->uploader_model->upload_error());
                }
            }

            $result = $this->people_model->update($data, $people_id, $company_id);

            if($result && $upload)
            {
                $this->alert->success_alert("People has been updated successfully");
            }
            else if(!$result)
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("people/profile/$permalink");
        }
    }

    public function contact($permalink)
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $people_id = permalink_id($permalink);

        $data = array();
        $data["page"] = "People Contact";
        $data["menu"] = "people";
        $data["content"] = "website/pages/company/people_contact";
        $data["people"] = $this->people_model->read($people_id, $company_id);

        $this->load->view("website/template", $data);
    }

    public function update_contact($permalink)
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->form_validation->set_rules('jm-social-facebook', 'Facebook', 'max_length[100]');
        $this->form_validation->set_rules('jm-social-twitter', 'Twitter', 'max_length[100]');
        $this->form_validation->set_rules('jm-social-google', 'Google', 'max_length[100]');
        $this->form_validation->set_rules('jm-social-linkedin', 'Linkedin', 'max_length[100]');
        $this->form_validation->set_rules('jm-contact-phone', 'Phone', 'required|max_length[100]');
        $this->form_validation->set_rules('jm-contact-email', 'Email', 'required|max_length[100]');
        $this->form_validation->set_rules('jm-contact-address', 'Address', 'required|max_length[100]');
        $this->form_validation->set_rules('jm-contact-website', 'Website', 'max_length[100]');

        if ($this->form_validation->run() == FALSE)
        {
            $people_id = permalink_id($permalink);

            $data = array();
            $data["page"] = "People Contact";
            $data["menu"] = "people";
            $data["content"] = "website/pages/company/people_contact";
            $data["people"] = $this->people_model->read($people_id, $company_id);

            $this->load->view("website/template", $data);
            $data["operation"] = "warning";
            $data["message"] = validation_errors();
        }
        else
        {
            $data = array(
                "plp_facebook" => $this->input->post("jm-social-facebook"),
                "plp_twitter" => $this->input->post("jm-social-twitter"),
                "plp_google" => $this->input->post("jm-social-google"),
                "plp_linkedin" => $this->input->post("jm-social-linkedin"),
                "plp_contact" => $this->input->post("jm-contact-phone"),
                "plp_email" => $this->input->post("jm-contact-email"),
                "plp_address" => $this->input->post("jm-contact-address"),
                "plp_website" => $this->input->post("jm-contact-website"),
            );

            $result = $this->people_model->update($data, permalink_id($permalink), $company_id);

            if($result)
            {
                $this->alert->success_alert("People contact has been updated successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("people/contact/$permalink");
        }
    }

    public function work($permalink)
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $people_id = permalink_id($permalink);

        $data = array();
        $data["page"] = "People Work";
        $data["menu"] = "people";
        $data["content"] = "website/pages/company/people_work";
        $data["job"] = $this->people_section_model->read(9, $people_id);
        $data["daily"] = $this->people_section_model->read(10, $people_id);
        $data["opinion"] = $this->people_section_model->read(11, $people_id);
        $data["people"] = $this->people_model->read($people_id, $company_id);

        $this->load->view("website/template", $data);
    }

    public function update_work($permalink)
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $people_id = permalink_id($permalink);

        $this->form_validation->set_rules('jm-work-title', 'Work', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-work-description', 'Work Description', 'required|max_length[2000]');
        $this->form_validation->set_rules('jm-daily-title', 'Daily', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-daily-description', 'Daily Description', 'required|max_length[2000]');
        $this->form_validation->set_rules('jm-opinion-title', 'Opinion', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-opinion-description', 'Opinion Description', 'required|max_length[2000]');

        if($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data["page"] = "People Work";
            $data["menu"] = "people";
            $data["content"] = "website/pages/company/people_work";
            $data["job"] = $this->people_section_model->read(9, $people_id);
            $data["daily"] = $this->people_section_model->read(10, $people_id);
            $data["opinion"] = $this->people_section_model->read(11, $people_id);
            $data["people"] = $this->people_model->read($people_id, $company_id);
            $data["operation"] = "warning";
            $data["message"] = validation_errors();

            $this->load->view("website/template", $data);
        }
        else {
            $data_work = array(
                "pst_title" => $this->input->post("jm-work-title"),
                "pst_description" => $this->input->post("jm-work-description")
            );

            $data_daily = array(
                "pst_title" => $this->input->post("jm-daily-title"),
                "pst_description" => $this->input->post("jm-daily-description")
            );

            $data_opinion = array(
                "pst_title" => $this->input->post("jm-opinion-title"),
                "pst_description" => $this->input->post("jm-opinion-description")
            );

            $result_work = $this->section_model->update($data_work, 9, $people_id);
            $result_daily = $this->section_model->update($data_daily, 10, $people_id);
            $result_opinion = $this->section_model->update($data_opinion, 11, $people_id);

            if ($result_work && $result_daily && $result_opinion) {
                $this->alert->success_alert("Company office has been updated successfully");
            } else{
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("people/work/$permalink");
        }
    }

    public function photo($permalink)
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $people_id = permalink_id($permalink);

        $data = array();
        $data["page"] = "People Photo";
        $data["menu"] = "people";
        $data["content"] = "website/pages/company/people_photo";
        $data["photos"] = $this->people_photo_model->read_by_people($people_id);
        $data["people"] = $this->people_model->read($people_id, $company_id);

        $this->load->view("website/template", $data);
    }

    public function delete()
    {

    }


}