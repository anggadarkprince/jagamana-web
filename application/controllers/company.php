<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 4:27 PM
 */

class Company extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CompanyModel","company_model");
        $this->load->model("CompanySizeModel","size_model");
        $this->load->model("CompanyFieldModel","field_model");
        $this->load->model("CountryModel","country_model");
        $this->load->model("CityModel","city_model");
        $this->load->model("CompanySectionModel","section_model");
        $this->load->model("CompanyTaskModel","task_model");
        $this->load->model("FollowerModel","follower_model");
        $this->load->model("AchievementModel","achievement_model");
        $this->load->model("PeopleModel","people_model");
        $this->load->model("PeoplePhotoModel","people_photo_model");
        $this->load->model("PeopleSectionModel","people_section_model");
        $this->load->model("CompanyPhotoModel","photo_model");
        $this->load->model("JobModel","job_model");
        $this->load->library("Pagination", "pagination");
    }

    public function index()
    {
        $data = array();
        $data["page"] = "Companies";
        $data["menu"] = "company";
        $data["content"] = "website/pages/public/companies";
        $data["fields"] = $this->field_model->read();
        $data["sizes"] = $this->size_model->read();
        $data["cities"] = $this->city_model->read_indonesia_city();
        $this->load->view("website/template", $data);

        $this->company_model->read(0,10,"'ACTIVE'");
    }

    public function filter()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $field = $this->input->post("field");
            $size = $this->input->post("size");
            $city = $this->input->post("city");
            $company = $this->input->post("company");

            if($company != null){
                $company = explode(",",$company);
            }

            $data = $this->company_model->read($this->uri->segment(3),10,"'ACTIVE'", $field, $city, $size, $company, true);

            $config['base_url'] = site_url().'company/filter';
            $config['total_rows'] = $this->company_model->get_company_total();
            $config['uri_segment'] = 3;
            $this->pagination->initialize($config);

            for($i = 0; $i < count($data); $i++){
                $data[$i]["permalink"] = permalink($data[$i]["company"],$data[$i]["company_id"]);
            }

            echo json_encode(array("company"=>$data, "pagination" => $this->pagination->create_links()));
        }
        else{
            redirect("error404");
        }
    }

    public function about($company)
    {
        $id = permalink_id($company);

        $data = array();
        $data["page"] = "Company Profile";
        $data["menu"] = "company";
        $data["content"] = "website/pages/public/company_about";
        $data["company"] = $this->company_model->read_by_id($id);
        $data["followers"] = $this->follower_model->read_by_company($id);
        $data["tasks"] = $this->task_model->read_by_company($id);
        $data["who"] = $this->section_model->read(1, $id);
        $data["office"] = $this->section_model->read(2, $id);
        $data["expectation"] = $this->section_model->read(3, $id);
        $data["opinion"] = $this->section_model->read(4, $id);
        $data["achievements"] = $this->achievement_model->read_by_company($id);
        $data["people"] = $this->people_model->read_by_company($id);
        $data["photos"] = $this->photo_model->read_by_company($id, "SECONDARY");
        $data["jobs"] = $this->job_model->read_by_company($id);
        $this->load->view("website/template", $data);
    }

    public function office($company)
    {
        $id = permalink_id($company);
        $data = array();
        $data["page"] = "Company Office";
        $data["menu"] = "company";
        $data["content"] = "website/pages/public/company_office";
        $data["company"] = $this->company_model->read_by_id($id);
        $data["life"] = $this->section_model->read(5, $id);
        $data["location"] = $this->section_model->read(6, $id);
        $data["world"] = $this->section_model->read(7, $id);
        $data["unique"] = $this->section_model->read(8, $id);
        $data["primary"] = $this->photo_model->read_by_company($id, "PRIMARY");
        $data["secondary"] = $this->photo_model->read_by_company($id, "SECONDARY");
        $data["photos"] = $this->photo_model->read_by_company($id, "OTHER");
        $this->load->view("website/template", $data);

    }

    public function people($company)
    {
        $id = permalink_id($company);
        $data = array();
        $data["page"] = "Company People";
        $data["menu"] = "company";
        $data["content"] = "website/pages/public/company_people";
        $data["company"] = $this->company_model->read_by_id($id);
        $data["people"] = $this->people_model->read_by_company($id);
        $this->load->view("website/template", $data);
    }

    public function person($people, $company)
    {
        $id = permalink_id($people);
        $data = array();
        $data["page"] = "Company People";
        $data["menu"] = "company";
        $data["content"] = "website/pages/public/company_person";
        $data["company"] = $this->company_model->read_by_id($company);
        $data["person"] = $this->people_model->read($id);
        $data["work"] = $this->people_section_model->read(9, $id);
        $data["daily"] = $this->people_section_model->read(10, $id);
        $data["opinion"] = $this->people_section_model->read(11, $id);
        $data["photos"] = $this->people_photo_model->read_by_people($id);
        $this->load->view("website/template", $data);
    }

    public function job($company)
    {
        $id = permalink_id($company);
        $data = array();
        $data["page"] = "Company Job";
        $data["menu"] = "company";
        $data["content"] = "website/pages/public/company_jobs";
        $data["company"] = $this->company_model->read_by_id($id);
        $data["jobs"] = $this->job_model->read_by_company($id);
        $this->load->view("website/template", $data);
    }

}