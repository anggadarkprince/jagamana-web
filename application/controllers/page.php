<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 4:51 PM
 */

class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        unique_visitor();

        $this->load->library('form_validation');

        $this->load->model("CompanyModel","company_model");
        $this->load->model("JobModel","job_model");
        $this->load->model("CategoryModel","category_model");
        $this->load->model("ThreadModel","thread_model");

        $data               = array();
        $data["page"]       = "Home";
        $data["menu"]       = "home";
        $data["content"]    = "website/pages/public/home";
        $data["companies"]  = $this->company_model->read_featured();
        $data["jobs"]       = $this->job_model->read_featured();
        $data["categories"] = $this->category_model->read(0,26);
        $data["threads"]    = $this->thread_model->read(0, 10, "PUBLISHED");

        $this->load->view("website/template", $data);
    }

    public function search()
    {
        $this->load->model("CompanyModel","company_model");
        $this->load->model("EmployeeModel", "employee_model");
        $this->load->model("JobModel", "job_model");

        $query = $this->input->get("query");
        $section = $this->input->get("section");

        if($section != null)
        {
            $this->load->library("Pagination", "pagination");
            if($section == "job")
            {
                $data                   = array();
                $data["page"]           = "Job Search Result";
                $data["content"]        = "website/pages/public/result_job";
                $data["keyword"]        = $query;
                $data["jobs"]           = $this->job_model->search($query,$this->uri->segment(3),10);
                $data["jobs_total"]     = $this->job_model->get_job_total();

                $config['suffix']       = "?".http_build_query($_GET,"","&");
                $config['base_url']     = site_url()."page/search";
                $config['first_url']    = $config["base_url"]."?".http_build_query($_GET);
                $config['total_rows']   = $this->job_model->get_job_total();
                $config['uri_segment']  = 3;
                $this->pagination->initialize($config);

                $this->load->view("website/template", $data);
            }
            else if($section == "company")
            {
                $data                       = array();
                $data["page"]               = "Company Search Result";
                $data["content"]            = "website/pages/public/result_company";
                $data["keyword"]            = $query;
                $data["companies"]          = $this->company_model->search($query,$this->uri->segment(3),10);
                $data["companies_total"]    = $this->company_model->get_company_total();

                $config['suffix']           = "?".http_build_query($_GET,"","&");
                $config['base_url']         = site_url()."page/search";
                $config['first_url']        = $config["base_url"]."?".http_build_query($_GET);
                $config['total_rows']       = $this->company_model->get_company_total();
                $config['uri_segment']      = 3;
                $this->pagination->initialize($config);

                $this->load->view("website/template", $data);
            }
            else if($section == "employee")
            {
                $data                       = array();
                $data["page"]               = "Employee Search Result";
                $data["content"]            = "website/pages/public/result_employee";
                $data["keyword"]            = $query;
                $data["employees"]          = $this->employee_model->search($query,$this->uri->segment(3),10);
                $data["employees_total"]    = $this->employee_model->get_employee_total();

                $config['suffix']           = "?".http_build_query($_GET,"","&");
                $config['base_url']         = site_url()."page/search";
                $config['first_url']        = $config["base_url"]."?".http_build_query($_GET);
                $config['total_rows']       = $this->employee_model->get_employee_total();
                $config['uri_segment']      = 3;
                $this->pagination->initialize($config);

                $this->load->view("website/template", $data);
            }
            else{
                redirect("error404");
            }
        }
        else{
            $data                       = array();
            $data["page"]               = "Search Result";
            $data["content"]            = "website/pages/public/result";
            $data["keyword"]            = $query;
            $data["companies"]          = $this->company_model->search($query,0,3);
            $data["companies_total"]    = $this->company_model->get_company_total();
            $data["jobs"]               = $this->job_model->search($query,0,3);
            $data["jobs_total"]         = $this->job_model->get_job_total();
            $data["employees"]          = $this->employee_model->search($query,0,3);
            $data["employees_total"]    = $this->employee_model->get_employee_total();
            $this->load->view("website/template", $data);
        }

    }

    public function subscribe()
    {
        $this->load->model("SubscriberModel", "subscriber_model");

        $email = $this->input->post("jm-subscribe-email");

        $result = $this->subscriber_model->subscribe($email);

        $data               = array();
        $data["page"]       = "Search Result";
        $data["content"]    = "website/pages/public/subscribe";
        $data["status"]     = $result;
        $this->load->view("website/template", $data);
    }

    public function unsubscribe($email)
    {
        $this->load->model("SubscriberModel", "subscriber_model");
        $result = $this->subscriber_model->unsubscribe(urldecode($email));

        $data               = array();
        $data["page"]       = "Search Result";
        $data["content"]    = "website/pages/public/unsubscribe";
        $data["status"]     = $result;
        $this->load->view("website/template", $data);
    }

    public function newsletter()
    {
        $this->load->model("SubscriberModel", "subscriber_model");
        $this->subscriber_model->send_newsletter();
        echo "Batch newsletter has been sent";
    }

    public function updates()
    {
        $this->load->model("SubscriberModel", "subscriber_model");
        $this->subscriber_model->send_update();
        echo "Batch updates have been sent";
    }

    public function login()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE) || UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            redirect("dashboard");
        }
        else{
            $this->load->library('form_validation');
            $data               = array();
            $data["page"]       = "Login";
            $data["menu"]       = "home";
            $data["content"]    = "website/pages/public/login";
            $this->load->view("website/template", $data);
        }
    }

    public function forgot($role, $token)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE) || UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            redirect("dashboard");
        }
        else{
            $this->load->model("UserModel","user_model");
            $this->load->library('form_validation');

            $account = $this->user_model->data_user($role, $token);

            $data               = array();
            $data["page"]       = "Forgot Password";
            $data["menu"]       = "home";
            $data["content"]    = "website/pages/public/reset";
            $data["account"]    = $account;

            $this->load->view("website/template", $data);
        }

    }

    public function recovery($role, $token)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE) || UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            redirect("dashboard");
        }
        else{
            $this->load->model("UserModel","user_model");
            $this->load->library('form_validation');

            $account = $this->user_model->data_user($role, $token);

            if($account == null)
            {
                redirect("page/index");
            }
            else{
                $data               = array();
                $data["page"]       = "Recovery";
                $data["menu"]       = "home";
                $data["content"]    = "website/pages/public/recovery";
                $data["account"]    = $account;

                $this->load->view("website/template", $data);
            }
        }
    }

    public function recovered()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE) || UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            redirect("dashboard");
        }
        else{
            $this->load->model("UserModel","user_model");
            $this->load->library('form_validation');

            $data               = array();
            $data["page"]       = "Password Recovered";
            $data["menu"]       = "home";
            $data["content"]    = "website/pages/public/recovered";

            $this->load->view("website/template", $data);
        }
    }

    public function register()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE) || UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            redirect("dashboard");
        }
        else{
            $this->load->library('form_validation');

            $data               = array();
            $data["page"]       = "Register";
            $data["menu"]       = "home";
            $data["content"]    = "website/pages/public/register";

            $this->load->view("website/template", $data);
        }
    }

    public function registered($role, $id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE) || UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            redirect("dashboard");
        }
        else{
            $this->load->model("UserModel","user_model");

            if($this->user_model->check_active_id($id))
            {
                $this->alert->warning_alert("Your account has been activated");
                redirect("page/login");
            }
            else{
                $data               = array();
                $data["page"]       = "Registered";
                $data["menu"]       = "home";
                $data["content"]    = "website/pages/public/registered";
                $data["role"]       = $role;
                $data["id"]         = $id;

                $this->load->view("website/template", $data);
            }
        }
    }

    public function privacy()
    {
        $data               = array();
        $data["page"]       = "Privacy";
        $data["content"]    = "website/pages/public/privacy";

        $this->load->view("website/template", $data);
    }

    public function disclaimer()
    {
        $data               = array();
        $data["page"]       = "Disclaimer";
        $data["content"]    = "website/pages/public/disclaimer";

        $this->load->view("website/template", $data);
    }

    public function help()
    {
        $data               = array();
        $data["page"]       = "Help";
        $data["content"]    = "website/pages/public/help";

        $this->load->view("website/template", $data);
    }

    public function contact()
    {
        $data               = array();
        $data["page"]       = "Contact";
        $data["content"]    = "website/pages/public/contact";

        $this->load->view("website/template", $data);
    }

}