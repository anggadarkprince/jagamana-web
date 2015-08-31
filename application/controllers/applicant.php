<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/10/2015
 * Time: 5:55 PM
 */

class Applicant extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            redirect(base_url());
        }

        $this->load->model("ApplicationModel", "application_model");
    }

    public function index()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Applicant";
        $data["menu"] = "applicant";
        $data["content"] = "website/pages/company/applicants";
        $data["applicants"] = $this->application_model->read_by_company($company);

        $this->load->view("website/template", $data);
    }

    public function resume($id)
    {
        $this->load->model("ResumePrinter", "resume_printer");
        $this->resume_printer->generate_resume($id);
    }
}