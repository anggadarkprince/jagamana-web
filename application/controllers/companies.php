<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/15/2015
 * Time: 4:20 PM
 */

class Companies extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR)) {
            redirect(base_url());
        }

        $this->load->model("CompanyModel", "company_model");
        $this->load->model("CompanyFieldModel", "field_model");
        $this->load->model("CompanySizeModel", "size_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->session->unset_userdata("jm_new_company");

        $data = array();
        $data["page"] = "Company";
        $data["menu"] = "company";
        $data["content"] = "administrator/pages/companies";
        $data["companies"] = $this->company_model->read(null, null, "'ACTIVE','PENDING'");

        $this->load->view("administrator/template",$data);
    }

    public function suspended()
    {
        $data = array();
        $data["page"] = "Company Suspended";
        $data["menu"] = "company";
        $data["content"] = "administrator/pages/companies_suspended";
        $data["companies"] = $this->company_model->read(null, null, "'SUSPEND'");

        $this->load->view("administrator/template",$data);
    }

    public function field()
    {
        $data = array();
        $data["page"] = "Company Field";
        $data["menu"] = "company";
        $data["content"] = "administrator/pages/companies_field";
        $data["fields"] = $this->field_model->read();

        $this->load->view("administrator/template",$data);
    }

    public function size()
    {
        $data = array();
        $data["page"] = "Company Size";
        $data["menu"] = "company";
        $data["content"] = "administrator/pages/companies_size";
        $data["sizes"] = $this->size_model->read();

        $this->load->view("administrator/template",$data);
    }

    public function suspend($id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $id = permalink_id($id);

            $result = $this->company_model->suspending($id);

            if($result)
            {
                $this->alert->warning_alert("Company has been suspended successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("companies");
        }
        else
        {
            redirect("show404");
        }
    }

    public function activate($id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $id = permalink_id($id);

            $result = $this->company_model->activating($id);

            if($result)
            {
                $this->alert->success_alert("Company has been activated successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("companies/suspended");
        }
        else
        {
            redirect("show404");
        }
    }

    public function delete($id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $result = $this->company_model->delete($id);

            if($result)
            {
                $this->alert->warning_alert("Company has been deleted successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("companies");
        }
        else
        {
            redirect("show404");
        }
    }

    public function delete_all()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $collectid = $this->input->post("checkid");

            $result = true;
            foreach($collectid as $id):
                $delete = $this->company_model->delete($id);
                if(!$delete){
                    $result = false;
                }
            endforeach;

            if($result)
            {
                $this->alert->success_alert("Selected Company has been removed successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("companies");
        }
        else
        {
            redirect("administrator");
        }
    }

}