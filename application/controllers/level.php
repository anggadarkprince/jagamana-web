<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/14/2015
 * Time: 2:40 PM
 */

class Level extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR)) {
            redirect(base_url());
        }

        $this->load->model("JobLevelModel","level_model");

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
                "jlv_level" => $this->input->post("jm-level-name"),
                "jlv_description" => $this->input->post("jm-level-description")
            );

            $result = $this->level_model->create($data);

            if($result)
            {
                $this->alert->success_alert("Level has been created successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("jobs/level");
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
                "jlv_level" => $this->input->post("jm-level-name"),
                "jlv_description" => $this->input->post("jm-level-description")
            );

            $result = $this->level_model->update($data, $id);

            if($result)
            {
                $this->alert->success_alert("Level has been updated successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("jobs/level");
        }
    }

    public function delete($id)
    {
        $result = $this->level_model->delete($id);

        if($result)
        {
            $this->alert->success_alert("Level has been removed successfully");
        }
        else
        {
            $this->alert->danger_alert("Something is getting wrong");
        }

        redirect("jobs/level");
    }

    private function _check_validation()
    {
        $this->form_validation->set_rules('jm-level-name', 'Level', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-level-description', 'Description', 'required|max_length[200]');

        return $this->form_validation->run();
    }

    private function _repopulate()
    {
        $data = array();
        $data["page"] = "Companies Level";
        $data["menu"] = "company";
        $data["content"] = "administrator/pages/companies_size";
        $data["categories"] = $this->level_model->read();
        $data["operation"] = "warning";
        $data["message"] = validation_errors();

        $this->load->view("administrator/template", $data);
    }

}