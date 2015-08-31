<?php
/**
 * Created by PhpStorm.
 * User: Sketch Project Studio
 * Date: 3/25/2015
 * Time: 8:46 PM
 */

class Achievement extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_COMPANY)) {
            redirect(base_url());
        }

        $this->load->model("AchievementModel","achievement_model");

        $this->load->library('form_validation');
    }

    public function create()
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        if (!$this->_check_validation())
        {
            $this->_repopulate($company_id);
        }
        else
        {
            $data = array(
                "ach_award" => $this->input->post("jm-achievement-award"),
                "ach_description" => $this->input->post("jm-achievement-description"),
                "ach_earned" => $this->input->post("jm-achievement-earned"),
                "ach_company" => $company_id
            );

            $result = $this->achievement_model->create($data);

            if($result)
            {
                $this->alert->success_alert("Achievement has been created successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("profile/achievement");
        }
    }

    public function update($id)
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        if (!$this->_check_validation())
        {
            $this->_repopulate($company_id);
        }
        else
        {
            $data = array(
                "ach_award" => $this->input->post("jm-achievement-award"),
                "ach_description" => $this->input->post("jm-achievement-description"),
                "ach_earned" => $this->input->post("jm-achievement-earned"),
                "ach_company" => $company_id
            );

            $result = $this->achievement_model->update($data, $id, $company_id);

            if($result)
            {
                $this->alert->success_alert("Achievement has been updated successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("profile/achievement");
        }
    }

    public function delete($id)
    {
        $company_id = $this->session->userdata(UserModel::$SESSION_ID);

        $result = $this->achievement_model->delete($id, $company_id);

        if($result)
        {
            $this->alert->success_alert("Achievement has been removed successfully");
        }
        else
        {
            $this->alert->danger_alert("Something is getting wrong");
        }

        redirect("profile/achievement");
    }

    private function _check_validation()
    {
        $this->form_validation->set_rules('jm-achievement-award', 'Award', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-achievement-description', 'Description', 'required|max_length[150]');
        $this->form_validation->set_rules('jm-achievement-earned', 'Earned', 'required');

        return $this->form_validation->run();
    }

    private function _repopulate($company)
    {
        $data = array();
        $data["page"] = "Profile Achievement";
        $data["menu"] = "profile";
        $data["content"] = "website/pages/company/profile_achievement";
        $data["achievements"] = $this->achievement_model->read_by_company($company);
        $data["operation"] = "warning";
        $data["message"] = validation_errors();

        $this->load->view("website/template", $data);
    }


}