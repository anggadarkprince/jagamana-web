<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 5:27 PM
 */

class Job extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("CompanyModel", "company_model");
        $this->load->model("ApplicationModel", "application_model");
        $this->load->model("JobModel", "job_model");
        $this->load->model("CountryModel", "country_model");
        $this->load->model("StateModel", "state_model");
        $this->load->model("CityModel", "city_model");
        $this->load->model("JobLevelModel", "level_model");
        $this->load->model("JobFieldModel", "field_model");
        $this->load->model("JobTypeModel", "type_model");
        $this->load->model("ApplicationModel", "application_model");
        $this->load->library("Pagination", "pagination");
    }

    public function index()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            $company = $this->session->userdata(UserModel::$SESSION_ID);

            $data = array();
            $data["page"] = "Job";
            $data["menu"] = "job";
            $data["content"] = "website/pages/company/jobs";
            $data["jobs"] = $this->job_model->read_by_company($company);

            $this->load->view("website/template", $data);
        }
        else
        {
            redirect("page/login");
        }
    }

    public function filter($type = null, $year = null, $month = null, $date = null)
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $field = $this->input->post("field");
            $level = $this->input->post("level");
            $city = $this->input->post("city");
            $company = $this->input->post("company");

            if($company != null){
                $company = explode(",",$company);
            }
            if($year != null && $month != null && $date != null){
                $date_filter = "$year-$month-$date";
                $data = $this->job_model->read($this->uri->segment(7),10,"ACTIVE", $field, $city, $level, array(strtoupper($type)), $company, true, true, $date_filter);

                $config['base_url'] = site_url().'job/filter/'.$this->uri->segment(3);
                $config['total_rows'] = $this->job_model->get_job_total();
                $config['uri_segment'] = 7;
                $this->pagination->initialize($config);
            }
            else{
                if($type == "all"){
                    $data = $this->job_model->read($this->uri->segment(4),10,"ACTIVE", $field, $city, $level, null, $company, true, true);

                    $config['base_url'] = site_url().'job/filter/'.$this->uri->segment(3);
                    $config['total_rows'] = $this->job_model->get_job_total();
                    $config['uri_segment'] = 4;
                    $this->pagination->initialize($config);
                }
                else{
                    $data = $this->job_model->read($this->uri->segment(4),10,"ACTIVE", $field, $city, $level, array(strtoupper($type)), $company, true, true);

                    $config['base_url'] = site_url().'job/filter/'.$this->uri->segment(3);
                    $config['total_rows'] = $this->job_model->get_job_total();
                    $config['uri_segment'] = 4;
                    $this->pagination->initialize($config);
                }
            }


            for($i = 0; $i < count($data); $i++){
                $data[$i]["permalink"] = permalink($data[$i]["vacancy"],$data[$i]["job_id"]);
            }

            echo json_encode(array("job"=>$data, "pagination" => $this->pagination->create_links()));
        }
        else{
            redirect("error404");
        }
    }

    public function all()
    {
        $data = array();
        $data["page"] = "Full Time Job";
        $data["menu"] = "fulltime";
        $data["content"] = "website/pages/public/jobs";
        $data["fields"] = $this->field_model->read();
        $data["levels"] = $this->level_model->read();
        $data["cities"] = $this->city_model->read_indonesia_city();

        $this->load->view("website/template", $data);
    }

    public function fulltime()
    {
        $data = array();
        $data["page"] = "Full Time Job";
        $data["menu"] = "fulltime";
        $data["content"] = "website/pages/public/fulltime";
        $data["fields"] = $this->field_model->read();
        $data["levels"] = $this->level_model->read();
        $data["cities"] = $this->city_model->read_indonesia_city();

        $this->load->view("website/template", $data);
    }

    public function freelance()
    {
        $year = $this->uri->segment(3);
        $month = $this->uri->segment(4);
        if ($year == '')
            $year  = date("Y");

        if ($month == '')
            $month = date("m");

        $pref['template']='
				{table_open}<table>{/table_open}

				{heading_row_start}<tr>{/heading_row_start}
				{heading_previous_cell}<th class="prevcell"><a href="{previous_url}"><i class="fa fa-chevron-circle-left"></i></a></th>{/heading_previous_cell}

				{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}

				{heading_next_cell}<th class="nextcell"><a href="{next_url}"><i class="fa fa-chevron-circle-right"></i></a></th>{/heading_next_cell}
				{heading_row_end}</tr>{/heading_row_end}

				{week_row_start}<tr class="weekname">{/week_row_start}
				{week_day_cell}<td>{week_day}</td>{/week_day_cell}
				{week_row_end}</tr>{/week_row_end}

				{cal_row_start}<tr>{/cal_row_start}
				{cal_cell_start}<td>{/cal_cell_start}

				{cal_cell_content}<a href="'.site_url().'job/archive/'.$year.'/'.$month.'/{day}.html" class="link-notes"><div class="date">{day}</div><div class="notes">{content}</div></a>{/cal_cell_content}
				{cal_cell_content_today}<div class="highlight"><a href="#" class="link-notes"><div class="date">{day}</div><div class="notes">{content}</div></a></div>{/cal_cell_content_today}

				{cal_cell_no_content}<div class="date">{day}</div>{/cal_cell_no_content}
				{cal_cell_no_content_today}<div class="highlight"><div class="date">{day}</div><div class="today hidden-xs">TODAY</div></div>{/cal_cell_no_content_today}

				{cal_cell_blank}&nbsp;{/cal_cell_blank}

				{cal_cell_end}</td>{/cal_cell_end}
				{cal_row_end}</tr>{/cal_cell_end}

				{table_close}</table>{/table_close}
			';
        $pref['month_type'] = 'long';
        $pref['day_type'] = 'short';
        $pref['start_day'] = 'monday';
        $pref['show_next_prev'] = true;
        $pref['next_prev_url'] = site_url()."job/freelance";

        $this->load->library('calendar', $pref);

        $data = array();
        $data["page"] = "Freelance Job";
        $data["menu"] = "freelance";
        $data["content"] = "website/pages/public/freelance";
        $data["fields"] = $this->field_model->read();
        $data["levels"] = $this->level_model->read();
        $data["cities"] = $this->city_model->read_indonesia_city();

        $data["calendar"] = array(
            'year'=>$year,
            'month'=>$month,
            'data'=>$this->job_model->read_freelance_group($year, $month)
        );

        $this->load->view("website/template", $data);
    }

    public function archive($year, $month, $date)
    {
        $data = array();
        $data["page"] = "Freelance Time Job";
        $data["menu"] = "freelance";
        $data["content"] = "website/pages/public/freelance_list";
        $data["fields"] = $this->field_model->read();
        $data["levels"] = $this->level_model->read();
        $data["cities"] = $this->city_model->read_indonesia_city();
        $data["archive"] = array("year"=>$year, "month"=>$month, "date"=>$date);

        $this->load->view("website/template", $data);
    }

    public function voluntary()
    {
        $data = array();
        $data["page"] = "Voluntary Job";
        $data["menu"] = "voluntary";
        $data["content"] = "website/pages/public/voluntary";
        $data["fields"] = $this->field_model->read();
        $data["levels"] = $this->level_model->read();
        $data["cities"] = $this->city_model->read_indonesia_city();

        $this->load->view("website/template", $data);
    }

    public function intern()
    {
        $data = array();
        $data["page"] = "Intern";
        $data["menu"] = "intern";
        $data["content"] = "website/pages/public/intern";
        $data["fields"] = $this->field_model->read();
        $data["levels"] = $this->level_model->read();
        $data["cities"] = $this->city_model->read_indonesia_city();

        $this->load->view("website/template", $data);
    }

    public function course()
    {
        $data = array();
        $data["page"] = "Course";
        $data["menu"] = "course";
        $data["content"] = "website/pages/public/course";
        $data["fields"] = $this->field_model->read();
        $data["levels"] = $this->level_model->read();
        $data["cities"] = $this->city_model->read_indonesia_city();

        $this->load->view("website/template", $data);
    }

    public function detail($permalink)
    {
        if($this->_is_valid_permalink($permalink, false))
        {
            $id = permalink_id($permalink);

            $data = array();
            $data["page"] = "Job";
            $data["content"] = "website/pages/public/job";
            $data["job"] = $this->job_model->read_by_id($id);
            $data["company"] = $this->company_model->read_by_id($data["job"]["company_id"]);
            $data["related"] = $this->job_model->read_by_company($data["job"]["company_id"]);
            $data["similar"] = $this->job_model->read_by_similar($data["job"]["field_id"]);
            $data["random"] = $this->job_model->read_by_random();
            $data["applicants"] = $this->application_model->read_by_job($id);
            $data["menu"] = strtolower($data["job"]["type"]);
            $this->load->view("website/template", $data);
        }
        else
        {
            redirect("error404");
        }

    }

    public function apply($permalink)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
        {
            $job_id = permalink_id($permalink);

            $data = array(
                "apl_employee" => $this->session->userdata(UserModel::$SESSION_ID),
                "apl_job" => $job_id
            );
            $result = $this->application_model->create($data);

            if($result)
            {
                $this->alert->success_alert("Job has been applied successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("job/detail/".$permalink);
        }
        else{
            redirect("page/login");
        }
    }

    public function create()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            $this->load->library('form_validation');

            $data = array();
            $data["page"] = "Create Job";
            $data["menu"] = "job";
            $data["content"] = "website/pages/company/job_create";
            $data["countries"] = $this->country_model->read();
            $data["fields"] = $this->field_model->read();
            $data["levels"] = $this->level_model->read();
            $data["types"] = $this->type_model->read();

            $this->load->view("website/template", $data);
        }
        else
        {
            redirect("page/login");
        }
    }

    public function save()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            $this->_check_validation();

            if ($this->form_validation->run() == FALSE)
            {
                $this->_repopulate("create");
            }
            else
            {
                $data = $this->_collect_data();

                $result = $this->job_model->create($data);

                if($result)
                {
                    $this->alert->success_alert("New job has been created successfully");
                }
                else
                {
                    $this->alert->danger_alert("Something is getting wrong");
                }

                redirect("job");
            }

        }
        else
        {
            redirect("page/login");
        }
    }

    public function edit($permalink)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            if($this->_is_valid_permalink($permalink))
            {
                $this->load->library('form_validation');

                $job_id = permalink_id($permalink);

                $data = array();
                $data["page"] = "Edit Job";
                $data["menu"] = "job";
                $data["job"] = $this->job_model->read_by_id($job_id);
                $data["cities"] = $this->city_model->read_by_state($data["job"]["state_id"]);
                $data["states"] = $this->state_model->read_by_country($data["job"]["country_id"]);
                $data["countries"] = $this->country_model->read();
                $data["fields"] = $this->field_model->read();
                $data["levels"] = $this->level_model->read();
                $data["types"] = $this->type_model->read();
                $data["content"] = "website/pages/company/job_edit";

                $this->load->view("website/template", $data);
            }
            else
            {
                $this->alert->danger_alert("Invalid permalink reference");
                redirect("job");
            }
        }
        else
        {
            redirect("page/login");
        }
    }

    public function update($permalink)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            if($this->_is_valid_permalink($permalink))
            {
                $job_id = permalink_id($permalink);

                $this->_check_validation();

                if($this->form_validation->run() == FALSE)
                {
                    $this->_repopulate("update", $job_id);
                }
                else
                {
                    $data = $this->_collect_data();

                    $result = $this->job_model->update($data, $job_id);

                    if($result)
                    {
                        $this->alert->success_alert("Job has been updated successfully");
                    }
                    else
                    {
                        $this->alert->danger_alert("Something is getting wrong");
                    }
                    redirect("job");
                }
            }
            else
            {
                $this->alert->danger_alert("Invalid permalink reference");
                redirect("job");
            }
        }
        else
        {
            redirect("page/login");
        }
    }

    public function delete($permalink)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            if($this->_is_valid_permalink($permalink))
            {
                $job_id = permalink_id($permalink);

                $company_id = $this->session->userdata(UserModel::$SESSION_ID);

                $result = $this->job_model->delete($job_id, $company_id);

                if($result)
                {
                    $this->alert->success_alert("Job has been removed successfully");
                }
                else
                {
                    $this->alert->danger_alert("Something is getting wrong");
                }
            }
            else
            {
                $this->alert->danger_alert("Invalid permalink reference");
            }

            redirect("job");
        }
        else
        {
            redirect("page/login");
        }
    }

    private function _collect_data()
    {
        $id_company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array(
            "job_company" => $id_company,
            "job_vacancy" => $this->input->post("jm-job-vacancy"),
            "job_field" => $this->input->post("jm-job-field"),
            "job_type" => $this->input->post("jm-job-type"),
            "job_level" => $this->input->post("jm-job-level"),
            "job_location" => $this->input->post("jm-job-location-city"),
            "job_description" => $this->input->post("jm-job-description"),
            "job_responsibility" => $this->input->post("jm-job-responsibility"),
            "job_qualification" => $this->input->post("jm-job-qualification"),
            "job_open" => date_format(date_create($this->input->post("jm-job-open")),"Y-m-d"),
            "job_close" => date_format(date_create($this->input->post("jm-job-close")),"Y-m-d"),
            "job_status" => ($this->input->post("jm-job-ready"))=="on"?"ACTIVE":"EXPIRED"
        );

        return $data;
    }

    private function _check_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('jm-job-vacancy', 'Title', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-job-field', 'Field', 'required');
        $this->form_validation->set_rules('jm-job-type', 'Type', 'required');
        $this->form_validation->set_rules('jm-job-level', 'Level', 'required');
        $this->form_validation->set_rules('jm-job-location-country', 'Country', 'required');
        $this->form_validation->set_rules('jm-job-location-province', 'Province', 'required');
        $this->form_validation->set_rules('jm-job-location-city', 'City', 'required');
        $this->form_validation->set_rules('jm-job-description', 'Description', 'required');
        $this->form_validation->set_rules('jm-job-responsibility', 'Responsibility', 'required');
        $this->form_validation->set_rules('jm-job-qualification', 'Qualification', 'required');
        $this->form_validation->set_rules('jm-job-open', 'Open', '');
        $this->form_validation->set_rules('jm-job-close', 'Close', '');
        $this->form_validation->set_rules('jm-job-ready', 'Job Status', '');
    }

    private function _repopulate($operation, $job_id = null)
    {
        $state = array();
        $city = array();

        if($this->input->post("jm-job-location-country") != null){
            $state = $this->state_model->read_by_country($this->input->post("jm-job-location-country"));
        }

        if($this->input->post("jm-job-location-province") != null){
            $city = $this->city_model->read_by_state($this->input->post("jm-job-location-province"));
        }

        $data = array();

        if($operation == "create")
        {
            $data["page"] = "Create Job";
            $data["content"] = "website/pages/company/job_create";
        }
        else{
            $data["page"] = "Update Job";
            $data["content"] = "website/pages/company/job_edit";
            $data["job"] = $this->job_model->read_by_id($job_id);
        }

        $data["menu"] = "job";
        $data["countries"] = $this->country_model->read();
        $data["states"] = $state;
        $data["cities"] = $city;
        $data["fields"] = $this->field_model->read();
        $data["levels"] = $this->level_model->read();
        $data["types"] = $this->type_model->read();
        $data["operation"] = "warning";
        $data["message"] = validation_errors();

        $this->load->view("website/template", $data);
    }

    private function _is_valid_permalink($permalink, $check_company = true)
    {
        if($check_company){
            $company_id = $this->session->userdata(UserModel::$SESSION_ID);
            $jobs = $this->job_model->read_by_company($company_id);
        }
        else{
            $jobs = $this->job_model->read(null, null, "ACTIVE");
        }

        $valid_permalink = false;
        foreach($jobs as $job):
            if(permalink($job["vacancy"], $job["job_id"]) == $permalink)
            {
                $valid_permalink = true;
                break;
            }
        endforeach;

        return $valid_permalink;
    }

}