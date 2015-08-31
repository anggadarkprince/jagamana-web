<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/11/2015
 * Time: 7:30 PM
 */

class Office extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_COMPANY)) {
            redirect(base_url());
        }

        $this->load->model("CompanyModel","company_model");
        $this->load->model("CompanyPhotoModel","company_photo_model");
        $this->load->model("CompanySectionModel", "section_model");
        $this->load->model("UploaderModel", "uploader_model");

        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->snapshot();
    }

    public function snapshot()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Office Snapshot";
        $data["menu"] = "office";
        $data["content"] = "website/pages/company/office_snapshot";
        $data["primary"] = $this->company_photo_model->read_by_company($company, "PRIMARY");
        $data["secondary"] = $this->company_photo_model->read_by_company($company, "SECONDARY");

        $this->load->view("website/template", $data);
    }

    public function update_snapshot()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $is_error = false;
        $error_message = "";

        $config = array(
            "allowed_types" => UploaderModel::$TYPE_IMAGE,
            "upload_path" => "./assets/img/office",
            "file_name" => $this->session->userdata(UserModel::$SESSION_ID),
            "overwrite" => TRUE,
            "max_width" => 2000,
            "max_height" => 2000
        );

        if ($_FILES["jm-snapshot-primary"]["size"] != 0 && $_FILES["jm-snapshot-primary"]["name"] != "") {
            $config["input_source"] = "jm-snapshot-primary";
            $config["file_name"] = "primary-" . $this->session->userdata(UserModel::$SESSION_ID);
            $uploader = new UploaderModel();
            $uploader->config($config);
            $upload = $uploader->start_upload();

            if ($upload) {
                $data_primary = array(
                    "cph_resource" => $uploader->upload_data()["file_name"],
                );
                $id = $this->input->post("jm-primary-id");
                $result_primary = $this->company_photo_model->update($data_primary, $id, $company);
                if ($result_primary) {
                    $this->alert->success_alert("Primary photo has been updated successfully");
                } else{
                    $this->alert->danger_alert("Something is getting wrong");
                }
            } else {
                $is_error = true;
                $error_message = $uploader->upload_error();
            }
        }

        for($i = 1; $i <= 3; $i++){
            $source = "jm-snapshot-secondary".$i;
            if ($_FILES[$source]["size"] != 0 && $_FILES[$source]["name"] != "") {
                $config["input_source"] = $source;
                $config["file_name"] = "secondary".$i."-" . $this->session->userdata(UserModel::$SESSION_ID);
                $uploader = new UploaderModel();
                $uploader->config($config);
                $upload = $uploader->start_upload();

                if ($upload) {
                    $data_primary = array(
                        "cph_resource" => $uploader->upload_data()["file_name"],
                    );
                    $id = $this->input->post("jm-secondary-id".$i);
                    $result_secondary = $this->company_photo_model->update($data_primary, $id, $company);
                    if ($result_secondary) {
                        $this->alert->success_alert("Secondary photo has been updated successfully");
                    } else{
                        $this->alert->danger_alert("Something is getting wrong");
                    }

                } else {
                    $is_error = true;
                    $error_message = $uploader->upload_error();
                }
            }
        }

        if($is_error){
            $this->alert->warning_alert($error_message);
        }

        redirect("office/snapshot");

    }

    public function profile()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Office Profile";
        $data["menu"] = "office";
        $data["content"] = "website/pages/company/office_profile";
        $data["life"] = $this->section_model->read(5, $company);
        $data["location"] = $this->section_model->read(6, $company);
        $data["company"] = $this->company_model->read_by_id($company);

        $this->load->view("website/template", $data);
    }

    public function profile_update()
    {
        $this->form_validation->set_rules('jm-life-title', 'Office Life', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-life-description', 'Office Description', 'required|max_length[2000]');
        $this->form_validation->set_rules('jm-life-status', 'Office Status', '');
        $this->form_validation->set_rules('jm-location-lat', 'Latitude', '');
        $this->form_validation->set_rules('jm-location-lng', 'Longitude', '');
        $this->form_validation->set_rules('jm-location-title', 'Location', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-location-description', 'Location Description', 'required|max_length[2000]');
        $this->form_validation->set_rules('jm-location-status', 'Location Status', '');

        $company = $this->session->userdata(UserModel::$SESSION_ID);

        if($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data["page"] = "Office Profile";
            $data["menu"] = "office";
            $data["content"] = "website/pages/company/office_profile";
            $data["life"] = $this->section_model->read(5, $company);
            $data["location"] = $this->section_model->read(6, $company);
            $data["company"] = $this->company_model->read_by_id($company);
            $data["operation"] = "warning";
            $data["message"] = validation_errors();

            $this->load->view("website/template", $data);
        }
        else {
            $data_office = array(
                "cst_title" => $this->input->post("jm-life-title"),
                "cst_description" => $this->input->post("jm-life-description"),
                "cst_active" => $this->input->post("jm-life-status")
            );

            $data_location = array(
                "cst_title" => $this->input->post("jm-location-title"),
                "cst_description" => $this->input->post("jm-location-description"),
                "cst_active" => $this->input->post("jm-location-status")
            );

            $data_company = array(
                "cmp_lat" => $this->input->post("jm-location-lat"),
                "cmp_lng" => $this->input->post("jm-location-lng"),
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

            if ($_FILES["jm-life-featured"]["size"] != 0 && $_FILES["jm-life-featured"]["name"] != "") {
                $config["input_source"] = "jm-life-featured";
                $config["file_name"] = "office-" . $this->session->userdata(UserModel::$SESSION_ID);
                $uploader = new UploaderModel();
                $uploader->config($config);
                $upload = $uploader->start_upload();

                if ($upload) {
                    $data_office["cst_featured"] = $config["file_name"] . $uploader->upload_data()["file_ext"];
                } else {
                    $this->alert->warning_alert($uploader->upload_error());
                }
            }

            $result_office = $this->section_model->update($data_office, 5, $company);

            if ($_FILES["jm-location-featured"]["size"] != 0 && $_FILES["jm-location-featured"]["name"] != "") {
                $config["input_source"] = "jm-location-featured";
                $config["file_name"] = "location-" . $this->session->userdata(UserModel::$SESSION_ID);
                $uploader = new UploaderModel();
                $uploader->config($config);
                $upload = $uploader->start_upload();

                if ($upload) {
                    $data_location["cst_featured"] = $config["file_name"] . $uploader->upload_data()["file_ext"];
                } else {
                    $this->alert->warning_alert($uploader->upload_error());
                }
            }

            $result_location = $this->section_model->update($data_location, 6, $company);

            $result_company = $this->company_model->update($data_company, $company);

            if ($result_office && $result_location && $result_company && $upload) {
                $this->alert->success_alert("Company office has been updated successfully");
            } else if (!$result_office || !$result_location || !$result_company) {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("office/profile");
        }
    }

    public function world()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Office World";
        $data["menu"] = "office";
        $data["content"] = "website/pages/company/office_world";
        $data["world"] = $this->section_model->read(7, $company);
        $data["unique"] = $this->section_model->read(8, $company);

        $this->load->view("website/template", $data);
    }

    public function update_world()
    {
        $this->form_validation->set_rules('jm-world-title', 'World', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-world-description', 'World Description', 'required|max_length[2000]');
        $this->form_validation->set_rules('jm-world-status', 'World Status', '');
        $this->form_validation->set_rules('jm-unique-title', 'Unique', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-unique-description', 'Unique Description', 'required|max_length[2000]');
        $this->form_validation->set_rules('jm-unique-status', 'Unique Status', '');

        $company = $this->session->userdata(UserModel::$SESSION_ID);

        if($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data["page"] = "Office World";
            $data["menu"] = "office";
            $data["content"] = "website/pages/company/office_world";
            $data["world"] = $this->section_model->read(7, $company);
            $data["unique"] = $this->section_model->read(8, $company);
            $data["operation"] = "warning";
            $data["message"] = validation_errors();

            $this->load->view("website/template", $data);
        }
        else {
            $data_world = array(
                "cst_title" => $this->input->post("jm-world-title"),
                "cst_description" => $this->input->post("jm-world-description"),
                "cst_active" => $this->input->post("jm-world-status")
            );

            $data_unique = array(
                "cst_title" => $this->input->post("jm-unique-title"),
                "cst_description" => $this->input->post("jm-unique-description"),
                "cst_active" => $this->input->post("jm-unique-status")
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

            if ($_FILES["jm-world-featured"]["size"] != 0 && $_FILES["jm-world-featured"]["name"] != "") {
                $config["input_source"] = "jm-world-featured";
                $config["file_name"] = "world-" . $this->session->userdata(UserModel::$SESSION_ID);
                $uploader = new UploaderModel();
                $uploader->config($config);
                $upload = $uploader->start_upload();

                if ($upload) {
                    $data_world["cst_featured"] = $config["file_name"] . $uploader->upload_data()["file_ext"];
                } else {
                    $this->alert->warning_alert($uploader->upload_error());
                }
            }

            $result_world = $this->section_model->update($data_world, 7, $company);

            if ($_FILES["jm-unique-featured"]["size"] != 0 && $_FILES["jm-unique-featured"]["name"] != "") {
                $config["input_source"] = "jm-unique-featured";
                $config["file_name"] = "unique-" . $this->session->userdata(UserModel::$SESSION_ID);
                $uploader = new UploaderModel();
                $uploader->config($config);
                $upload = $uploader->start_upload();

                if ($upload) {
                    $data_unique["cst_featured"] = $config["file_name"] . $uploader->upload_data()["file_ext"];
                } else {
                    $this->alert->warning_alert($uploader->upload_error());
                }
            }

            $result_unique = $this->section_model->update($data_unique, 8, $company);

            if ($result_world && $result_unique && $upload) {
                $this->alert->success_alert("Company office has been updated successfully");
            } else if (!$result_world || !$result_unique) {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("office/world");
        }
    }

    public function photo()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Office Photo";
        $data["menu"] = "office";
        $data["content"] = "website/pages/company/office_photo";
        $data["photos"] = $this->company_photo_model->read_by_company($company, "OTHER");

        $this->load->view("website/template", $data);
    }

}