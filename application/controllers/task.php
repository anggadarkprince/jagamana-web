<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:44 PM
 */

class Task extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_COMPANY)) {
            redirect(base_url());
        }

        $this->load->model("CompanyTaskModel","task_model");
        $this->load->model("UploaderModel", "uploader_model");
        $this->load->library('form_validation');
    }

    public function create()
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->form_validation->set_rules('jm-task-title', 'Task', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-task-description', 'Description', 'required|max_length[500]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate($company_id);
        }
        else
        {
            $data = array(
                "cts_task" => $this->input->post("jm-task-title"),
                "cts_description" => $this->input->post("jm-task-description"),
                "cts_company" => $company_id
            );

            $upload = true;

            if($_FILES["jm-task-featured"]["size"] != 0 && $_FILES["jm-task-featured"]["name"] != "")
            {
                $config = array(
                    "allowed_types" => UploaderModel::$TYPE_IMAGE,
                    "upload_path" => "./assets/img/office",
                    "file_name" => "task-".$this->session->userdata(UserModel::$SESSION_NAME)."-".uniqid(),
                    "overwrite" => FALSE,
                    "input_source" => "jm-task-featured",
                    "max_width" => 2000,
                    "max_height" => 2000
                );
                $this->uploader_model->config($config);

                $upload = $this->uploader_model->start_upload();

                if($upload)
                {
                    $data["cts_featured"] = $this->uploader_model->upload_data()["file_name"];
                }
                else
                {
                    $this->alert->warning_alert($this->uploader_model->upload_error());
                }
            }

            $result = $this->task_model->create($data);

            if($result && $upload)
            {
                $this->alert->success_alert("Task has been created successfully");
            }
            else if(!$result)
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("profile/task");
        }
    }

    public function update($id)
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->form_validation->set_rules('jm-task-title', 'Task', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-task-description', 'Description', 'required|max_length[500]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->_repopulate($company_id);
        }
        else
        {
            $data = array(
                "cts_task" => $this->input->post("jm-task-title"),
                "cts_description" => $this->input->post("jm-task-description"),
                "cts_company" => $company_id
            );

            $upload = true;

            if($_FILES["jm-task-featured"]["size"] != 0 && $_FILES["jm-task-featured"]["name"] != "")
            {
                $config = array(
                    "allowed_types" => UploaderModel::$TYPE_IMAGE,
                    "upload_path" => "./assets/img/office",
                    "file_name" => "task-".$this->session->userdata(UserModel::$SESSION_NAME)."-".uniqid(),
                    "overwrite" => FALSE,
                    "input_source" => "jm-task-featured",
                    "max_width" => 2000,
                    "max_height" => 2000
                );
                $this->uploader_model->config($config);

                $upload = $this->uploader_model->start_upload();

                if($upload)
                {
                    $data["cts_featured"] = $this->uploader_model->upload_data()["file_name"];
                }
                else
                {
                    $this->alert->warning_alert($this->uploader_model->upload_error());
                }
            }

            $result = $this->task_model->update($data, $id, $company_id);

            if($result && $upload)
            {
                $this->alert->success_alert("Task has been updated successfully");
            }
            else if(!$result)
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("profile/task");
        }
    }

    public function delete($id)
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $result = $this->task_model->delete($id, $company_id);

        if($result)
        {
            $this->alert->success_alert("Task has been removed successfully");
        }
        else
        {
            $this->alert->danger_alert("Something is getting wrong");
        }

        redirect("profile/task");
    }

    private function _repopulate($company)
    {
        $data = array();
        $data["page"] = "Profile Task";
        $data["menu"] = "profile";
        $data["content"] = "website/pages/company/profile_task";
        $data["tasks"] = $this->task_model->read_by_company($company);
        $data["operation"] = "warning";
        $data["message"] = validation_errors();

        $this->load->view("website/template", $data);
    }
}