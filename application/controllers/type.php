<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/14/2015
 * Time: 2:40 PM
 */

class Type extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR)) {
            redirect(base_url());
        }

        $this->load->model("JobFieldModel","field_model");

        $this->load->library('form_validation');
    }

    public function create()
    {
        if (!$this->_check_validation())
        {
            $this->_repopulate();
        }
        else
        {
            $data = array(
                "jfd_field" => $this->input->post("jm-field-name"),
                "jfd_description" => $this->input->post("jm-field-description")
            );

            $result = $this->field_model->create($data);

            if($result)
            {
                $this->alert->success_alert("Field has been created successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("jobs/field");
        }
    }

    public function update($id)
    {
        if (!$this->_check_validation())
        {
            $this->_repopulate();
        }
        else
        {
            $data = array(
                "jfd_field" => $this->input->post("jm-field-name"),
                "jfd_description" => $this->input->post("jm-field-description")
            );

            $result = $this->field_model->update($data, $id);

            if($result)
            {
                $this->alert->success_alert("Field has been updated successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("jobs/field");
        }
    }

    public function delete($id)
    {
        $result = $this->field_model->delete($id);

        if($result)
        {
            $this->alert->success_alert("Field has been removed successfully");
        }
        else
        {
            $this->alert->danger_alert("Something is getting wrong");
        }

        redirect("jobs/field");
    }

    private function _check_validation()
    {
        $this->form_validation->set_rules('jm-field-name', 'Field', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-field-description', 'Description', 'required|max_length[200]');

        return $this->form_validation->run();
    }

    private function _repopulate()
    {
        $data = array();
        $data["page"] = "Jobs Field";
        $data["menu"] = "job";
        $data["content"] = "administrator/pages/jobs_field";
        $data["categories"] = $this->field_model->read();
        $data["operation"] = "warning";
        $data["message"] = validation_errors();

        $this->load->view("administrator/template", $data);
    }

}