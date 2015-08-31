<?php

/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 8:33 PM
 */
class JobModel extends CI_Model
{
    public static $table_name = "jm_job";
    public static $view_name = "jm_view_job";
    public static $primary_key = "job_id";

    public static $foreign_company = "job_company";
    public static $foreign_field = "job_field";
    public static $foreign_type = "job_type";
    public static $foreign_level = "job_level";
    public static $foreign_location = "job_location";

    public static $FETCH_ROW = "fetch_row";
    public static $FETCH_ALL = "fetch_all";

    private $job_fetch = "fetch_all";
    private $job_condition;
    private $job_limit;
    private $job_total;

    public function __construct()
    {
        parent::__construct();
    }

    public function reset_condition()
    {
        $this->job_condition = "WHERE 1";
        $this->job_limit = "";
    }

    public function set_fetch($fetch)
    {
        $this->job_fetch = $fetch;
    }

    public function set_limit($start = 0, $limit = 10)
    {
        if(($start != null || $start >= 0) && ($limit != null && $limit > 0))
        {
            if($start == ""){
                $start = 0;
            }
            $this->job_limit .= " LIMIT $start,$limit";
        }
    }

    public function set_id($id)
    {
        $this->job_condition .= " AND jm_job.job_id = '$id'";
    }

    public function set_status($status = "ACTIVE")
    {
        if($status != null){
            $this->job_condition .= " AND status = '$status'";
        }
    }

    public function set_field($field = null)
    {
        if($field != null){
            $this->job_condition .= " AND field_id IN($field)";
        }
    }

    public function set_city($city = null)
    {
        if($city != null){
            $this->job_condition .= " AND city_id IN($city)";
        }
    }

    public function set_level($level = null)
    {
        if($level != null){
            $this->job_condition .= " AND level_id IN($level)";
        }
    }

    public function set_date($date = null)
    {
        if($date != null){
            $this->job_condition .= " AND job_open = '$date'";
        }
    }

    public function set_query($keyword)
    {
        if($keyword != null){
            $this->job_condition .= " AND vacancy LIKE '%$keyword%'";
        }
    }

    public function set_type($type = null, $label = false)
    {
        if($type != null){
            if($label){
                $first = true;
                foreach($type as $title):
                    if($first){
                        $this->job_condition .= " AND type LIKE '%$title%'";
                        $first = false;
                    }
                    else{
                        $this->job_condition .= " OR type LIKE '%$title%'";
                    }
                endforeach;
            }
            else{
                $this->job_condition .= " AND type_id IN($type)";
            }
        }
    }

    public function set_company($company = null, $label = false)
    {
        if($company != null){
            if($label){
                $first = true;
                foreach($company as $title):
                    if($first){
                        $this->job_condition .= " AND company LIKE '%$title%'";
                        $first = false;
                    }
                    else{
                        $this->job_condition .= " OR company LIKE '%$title%'";
                    }
                endforeach;
            }
            else{
                $this->job_condition .= " AND company_id IN($company)";
            }
        }
    }

    public function get_job_total()
    {
        return $this->job_total;
    }

    public function create($job)
    {
        $this->load->model("CompanyActivityModel", "company_activity_model");
        $this->company_activity_model->activity_job($job["job_vacancy"]);

        return $this->db->insert(JobModel::$table_name, $job);
    }

    public function read($start = null, $limit = null, $status = null, $field = null, $city = null, $level = null, $type = null, $company = null, $company_label = false, $type_label = false, $date = null)
    {
        $this->reset_condition();
        $this->set_fetch(JobModel::$FETCH_ALL);
        $this->set_limit($start, $limit);
        $this->set_status($status);
        $this->set_field($field);
        $this->set_city($city);
        $this->set_level($level);
        $this->set_type($type, $type_label);
        $this->set_company($company, $company_label);
        $this->set_date($date);
        return $this->read_query();
    }

    public function read_featured()
    {
        $this->reset_condition();
        $this->set_fetch(JobModel::$FETCH_ALL);
        $this->set_limit(0, 6);
        $this->set_status("ACTIVE");
        return $this->read_query();
    }

    public function read_by_id($id)
    {
        $this->reset_condition();
        $this->set_fetch(JobModel::$FETCH_ROW);
        $this->set_id($id);
        return $this->read_query();
    }

    public function read_by_company($company)
    {
        $this->reset_condition();
        $this->set_fetch(JobModel::$FETCH_ALL);
        $this->set_company("'".$company."'");
        $this->set_status("ACTIVE");
        return $this->read_query();
    }

    public function read_by_field($field)
    {
        $this->reset_condition();
        $this->set_fetch(JobModel::$FETCH_ALL);
        $this->set_field($field);
        $this->set_status("ACTIVE");
        return $this->read_query();
    }

    public function read_by_random()
    {
        $jobs = $this->read();
        $random = array();
        for($i = 0; $i < 3; $i++)
        {
            $index = rand(0,count($jobs)-1);
            $random[] = $jobs[$index];
        }
        return $random;
    }

    public function read_by_similar($field)
    {
        $jobs = $this->read_by_field($field);
        $random = array();
        $total = count($jobs)>3?3:count($jobs);
        for($i = 0; $i < $total; $i++)
        {
            $index = rand(0,count($jobs)-1);
            $random[] = $jobs[$index];
        }
        return $random;
    }

    public function read_query()
    {
        $employee = '';
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)){
            $employee = $this->session->userdata(UserModel::$SESSION_ID);
        }
        $query = "
            SELECT
              *,
              IF(apl_employee IS NULL, '0', '1') AS is_applied,
              IF(bmk_employee IS NULL, '0', '1') AS is_bookmarked

              FROM jm_view_job

              INNER JOIN jm_job
              ON jm_job.job_id = jm_view_job.job_id

              LEFT JOIN
                (SELECT *
                  FROM jm_application
                  WHERE apl_employee = '$employee'
                  ) application
                ON jm_job.job_id = apl_job

              LEFT JOIN
                (SELECT *
                  FROM jm_bookmark
                  WHERE bmk_employee = '$employee'
                  ) jm_bookmark
                ON jm_job.job_id = bmk_job

                ";

        $result = $this->db->query($query." ".$this->job_condition);

        $this->job_total = $result->num_rows();

        $query = $query." ".$this->job_condition." ".$this->job_limit;

        $result = $this->db->query($query);

        if($this->job_fetch == JobModel::$FETCH_ROW){
            $data = $result->row_array();
        }
        else{
            $data = $result->result_array();
        }

        return $data;
    }

    public function read_freelance_group($year, $month)
    {
        $query = "
          SELECT
            DAY(job_open) AS date ,
            COUNT(job_id) AS total

            FROM
              jm_job

            WHERE
              YEAR(job_open) = $year AND
              MONTH(job_open) = $month AND
              job_type = 2 AND
              DATE(job_open) IS NOT NULL

            GROUP BY
              DAY(job_open)
        ";

        $result = $this->db->query($query);
        $group = $result->result_array();

        $data = array();
        foreach($group as $row):
            $data[$row["date"]] = $row["total"]."<span class='hidden-xs'> JOBS</span>";
        endforeach;

        return $data;
    }

    public function get_statistic_list($company)
    {
        $this->db->where(JobModel::$foreign_company, $company);
        $this->db->from(JobModel::$table_name);
        return $this->db->count_all_results();
    }

    public function get_new_job()
    {
        $query = "SELECT COUNT(job_id) AS total FROM jm_job WHERE DATE(job_created_at) BETWEEN CURDATE() - INTERVAL 3 DAY AND CURDATE()";
        $result = $this->db->query($query)->row_array();
        return $result["total"];
    }

    public function get_newsletter()
    {
        $this->reset_condition();
        $this->set_fetch(JobModel::$FETCH_ALL);
        $this->set_limit(0, 5);
        $this->set_status("ACTIVE");
        return $this->read_query();
    }

    public function search($query, $start = null, $limit = null)
    {
        $this->reset_condition();
        $this->set_fetch(JobModel::$FETCH_ALL);
        $this->set_limit($start, $limit);
        $this->set_query($query);
        $this->set_status("ACTIVE");
        return $this->read_query();
    }

    public function update($company, $id)
    {
        $this->db->where(JobModel::$primary_key, $id);
        return $this->db->update(JobModel::$table_name, $company);
    }

    public function delete($id, $company = null)
    {
        $this->db->trans_start();

        $this->load->model("BookmarkModel");
        $this->load->model("ApplicationModel");

        # delete bookmark related by job
        $bookmark =  new BookmarkModel();
        $bookmark->delete_by_job($id);

        # delete application related by job
        $application = new ApplicationModel();
        $application->delete_by_job($id);

        # remove the job itself
        $condition = array(JobModel::$primary_key => $id);
        if($company != null){
            $condition["job_company"] = $company;
        }
        $this->db->delete(JobModel::$table_name, $condition);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function delete_by_field($field)
    {
        # get all jobs
        $condition = array(JobModel::$foreign_field => $field);
        $result = $this->db->get_where(JobModel::$table_name, $condition);
        $jobs = $result->result_array();

        $this->db->trans_start();

        foreach($jobs as $job):

            $this->delete($job[JobModel::$primary_key]);

        endforeach;

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function delete_by_level($level)
    {
        # get all jobs
        $condition = array(JobModel::$foreign_level => $level);
        $result = $this->db->get_where(JobModel::$table_name, $condition);
        $jobs = $result->result_array();

        $this->db->trans_start();

        foreach($jobs as $job):

            $this->delete($job[JobModel::$primary_key]);

        endforeach;

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function delete_by_company($company)
    {
        # get all jobs
        $condition = array(JobModel::$foreign_company => $company);
        $result = $this->db->get_where(JobModel::$table_name, $condition);
        $jobs = $result->result_array();

        $this->db->trans_start();

        foreach($jobs as $job):

            $this->delete($job[JobModel::$primary_key]);

        endforeach;

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}