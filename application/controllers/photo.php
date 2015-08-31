<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/11/2015
 * Time: 10:15 PM
 */

class Photo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("CompanyPhotoModel","company_photo_model");
        $this->load->model("PeoplePhotoModel","people_photo_model");
        $this->load->model("UploaderModel", "uploader_model");
        $this->load->library('form_validation');
    }

    public function create($type, $permalink = null)
    {
        if($type == "office")
        {
            $this->_create_office();
        }
        else if($type == "people")
        {
            $this->_create_people($permalink);
        }


    }

    private function _create_people($permalink)
    {
        $this->form_validation->set_rules('jm-photo-title', 'Title', 'required|max_length[45]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate_people($permalink);
        }
        else
        {
            $data = array(
                "pph_title" => $this->input->post("jm-photo-title"),
                "pph_people" => permalink_id($permalink)
            );

            $upload = true;

            if($_FILES["jm-photo-resource"]["size"] != 0 && $_FILES["jm-photo-resource"]["name"] != "")
            {
                $config = array(
                    "allowed_types" => UploaderModel::$TYPE_IMAGE,
                    "upload_path" => "./assets/img/people",
                    "file_name" => "photo-".$permalink."-".uniqid(),
                    "overwrite" => FALSE,
                    "input_source" => "jm-photo-resource",
                    "max_width" => 2000,
                    "max_height" => 2000
                );
                $this->uploader_model->config($config);

                $upload = $this->uploader_model->start_upload();

                if($upload)
                {
                    $data["pph_resource"] = $this->uploader_model->upload_data()["file_name"];
                }
                else
                {
                    $this->alert->warning_alert($this->uploader_model->upload_error());
                }
            }

            $result = $this->people_photo_model->create($data);

            if($result && $upload)
            {
                $this->alert->success_alert("Photo has been created successfully");
            }
            else if(!$result)
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("people/photo/$permalink");
        }
    }

    private function _create_office()
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->form_validation->set_rules('jm-photo-title', 'Title', 'required|max_length[45]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate($company_id);
        }
        else
        {
            $data = array(
                "cph_title" => $this->input->post("jm-photo-title"),
                "cph_type" => "OTHER",
                "cph_company" => $company_id
            );

            $upload = true;

            if($_FILES["jm-photo-resource"]["size"] != 0 && $_FILES["jm-photo-resource"]["name"] != "")
            {
                $config = array(
                    "allowed_types" => UploaderModel::$TYPE_IMAGE,
                    "upload_path" => "./assets/img/office",
                    "file_name" => "photo-".$this->session->userdata(UserModel::$SESSION_NAME)."-".uniqid(),
                    "overwrite" => FALSE,
                    "input_source" => "jm-photo-resource",
                    "max_width" => 2000,
                    "max_height" => 2000
                );
                $this->uploader_model->config($config);

                $upload = $this->uploader_model->start_upload();

                if($upload)
                {
                    $data["cph_resource"] = $this->uploader_model->upload_data()["file_name"];
                }
                else
                {
                    $this->alert->warning_alert($this->uploader_model->upload_error());
                }
            }

            $result = $this->company_photo_model->create($data);

            if($result && $upload)
            {
                $this->alert->success_alert("Photo has been created successfully");
            }
            else if(!$result)
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("office/photo");
        }
    }

    public function delete($type, $id)
    {
        if($type == "office"){
            $company_id = $this->session->userdata(UserModel::$SESSION_ID);

            $result = $this->company_photo_model->delete($id, $company_id);
        }
        else if($type == "people"){

            $people_id = permalink_id($id);

            $id_photo = $this->input->post("jm-delete-id");

            $result = $this->people_photo_model->delete($id_photo, $people_id);
        }
        else{
            $result = false;
        }

        if($result)
        {
            $this->alert->success_alert("Photo has been removed successfully");
        }
        else
        {
            $this->alert->danger_alert("Something is getting wrong");
        }

        if($type == "office") {
            redirect("office/photo");
        }
        else if($type == "people"){
            redirect("people/photo/$id");
        }
        else{
            show_404();
        }
    }

    private function _repopulate($company)
    {
        $data = array();
        $data["page"] = "Office Photo";
        $data["menu"] = "office";
        $data["content"] = "website/pages/company/office_photo";
        $data["photos"] = $this->company_photo_model->read_by_company($company, "OTHER");
        $data["operation"] = "warning";
        $data["message"] = validation_errors();

        $this->load->view("website/template", $data);
    }

    private function _repopulate_people($permalink)
    {
        $people_id = permalink_id($permalink);

        $data = array();
        $data["page"] = "People Photo";
        $data["menu"] = "people";
        $data["content"] = "website/pages/company/people_photo";
        $data["photos"] = $this->people_photo_model->read_by_people($people_id);
        $data["operation"] = "warning";
        $data["message"] = validation_errors();

        $this->load->view("website/template", $data);
    }

}