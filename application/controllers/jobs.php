<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/14/2015
 * Time: 8:51 PM
 */

class Jobs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR)) {
            redirect(base_url());
        }

        $this->load->model("JobModel", "job_model");
        $this->load->model("JobFieldModel", "field_model");
        $this->load->model("JobLevelModel", "level_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->session->unset_userdata("jm_new_job");

        $data = array();
        $data["page"] = "Jobs";
        $data["menu"] = "job";
        $data["content"] = "administrator/pages/jobs";
        $data["jobs"] = $this->job_model->read();

        $this->load->view("administrator/template",$data);
    }

    public function field()
    {
        $data = array();
        $data["page"] = "Jobs Field";
        $data["menu"] = "job";
        $data["content"] = "administrator/pages/jobs_field";
        $data["fields"] = $this->field_model->read();

        $this->load->view("administrator/template",$data);
    }

    public function level()
    {
        $data = array();
        $data["page"] = "Jobs Level";
        $data["menu"] = "job";
        $data["content"] = "administrator/pages/jobs_level";
        $data["levels"] = $this->level_model->read();

        $this->load->view("administrator/template",$data);
    }

    public function delete_all()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $collectid = $this->input->post("checkid");

            $result = true;
            foreach($collectid as $id):
                $delete = $this->job_model->delete($id);
                if(!$delete){
                    $result = false;
                }
            endforeach;

            if($result)
            {
                $this->alert->success_alert("Selected Jobs has been removed successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("jobs");
        }
        else
        {
            redirect("administrator");
        }
    }

}