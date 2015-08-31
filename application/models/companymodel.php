<?php

/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 8:08 PM
 */
class CompanyModel extends CI_Model
{

    public static $table_name = "jm_company";
    public static $view_name = "jm_view_company";
    public static $primary_key = "cmp_id";
    public static $view_key = "company_id";

    public static $foreign_field = "cmp_field";
    public static $foreign_size = "cmp_size";
    public static $foreign_location = "cmp_location";

    public static $field_token = "cmp_token";

    public static $FETCH_ROW = "fetch_row";
    public static $FETCH_ALL = "fetch_all";

    private $company_fetch = "fetch_all";
    private $company_condition;
    private $company_limit;
    private $company_total;

    private $active = "ACTIVE";
    private $suspend = "SUSPEND";

    public function __construct()
    {
        parent::__construct();
    }

    public function reset_condition()
    {
        $this->company_condition = "WHERE 1";
        $this->company_limit = "";
    }

    public function set_fetch($fetch)
    {
        $this->company_fetch = $fetch;
    }

    public function set_limit($start = 0, $limit = 10)
    {
        if(($start != null || $start >= 0) && ($limit != null && $limit > 0))
        {
            if($start == ""){
                $start = 0;
            }
            $this->company_limit .= " LIMIT $start,$limit";
        }
    }

    public function set_id($id)
    {
        $this->company_condition .= " AND company_id = '$id'";
    }

    public function set_status($status = "'ACTIVE'")
    {
        if($status != null){
            $this->company_condition .= " AND status IN ($status)";
        }
    }

    public function set_field($field = null)
    {
        if($field != null){
            $this->company_condition .= " AND field_id IN($field)";
        }
    }

    public function set_city($city = null)
    {
        if($city != null){
            $this->company_condition .= " AND city_id IN($city)";
        }
    }

    public function set_size($size = null)
    {
        if($size != null){
            $this->company_condition .= " AND size_id IN($size)";
        }
    }

    public function set_query($keyword)
    {
        if($keyword != null){
            $this->company_condition .= " AND company LIKE '%$keyword%'";
        }
    }

    public function set_company($company = null, $label = false)
    {
        if($company != null){
            if($label){
                $first = true;
                foreach($company as $title):
                    if($first){
                        $this->company_condition .= " AND company LIKE '%$title%'";
                        $first = false;
                    }
                    else{
                        $this->company_condition .= " OR company LIKE '%$title%'";
                    }
                endforeach;
            }
            else{
                $this->company_condition .= " AND company_id IN($company)";
            }
        }
    }

    public function get_company_total()
    {
        return $this->company_total;
    }

    public function activating($id)
    {
        $accept = array("cmp_status" => $this->active);
        $this->db->where(CompanyModel::$primary_key, $id);
        return $this->db->update(CompanyModel::$table_name, $accept);
    }

    public function suspending($id)
    {
        $accept = array("cmp_status" => $this->suspend);
        $this->db->where(CompanyModel::$primary_key, $id);
        return $this->db->update(CompanyModel::$table_name, $accept);
    }

    public function create($country)
    {
        return $this->db->insert(CompanyModel::$table_name, $country);
    }

    public function read($start = null, $limit = null, $status = null, $field = null, $city = null, $size = null, $company = null, $company_label = false)
    {
        $this->reset_condition();
        $this->set_fetch(CompanyModel::$FETCH_ALL);
        $this->set_limit($start, $limit);
        $this->set_status($status);
        $this->set_field($field);
        $this->set_city($city);
        $this->set_size($size);
        $this->set_company($company, $company_label);
        return $this->read_query();
    }

    public function read_by_id($id)
    {
        $this->reset_condition();
        $this->set_fetch(CompanyModel::$FETCH_ROW);
        $this->set_id($id);
        return $this->read_query();
    }

    public function read_featured()
    {
        $this->reset_condition();
        $this->set_fetch(CompanyModel::$FETCH_ALL);
        $this->set_limit(0, 6);
        $this->set_status("'ACTIVE'");
        return $this->read_query();
    }

    public function read_query()
    {
        $employee = $this->session->userdata(UserModel::$SESSION_ID);
        $query = "
            SELECT *, IF(flw_company IS NULL, '0', '1') AS is_followed

              FROM jm_view_company

              INNER JOIN jm_company
              ON company_id = cmp_id

              LEFT JOIN
                (SELECT *
                  FROM jm_follower
                  WHERE flw_employee = '$employee'
                  ) follower
                ON company_id = flw_company
                ";

        $result = $this->db->query($query." ".$this->company_condition);

        $this->company_total = $result->num_rows();

        $query = $query." ".$this->company_condition." ".$this->company_limit;

        $result = $this->db->query($query);

        if($this->company_fetch == CompanyModel::$FETCH_ROW){
            $data = $result->row_array();
        }
        else{
            $data = $result->result_array();
        }

        return $data;
    }

    public function get_new_company()
    {
        $query = "SELECT COUNT(cmp_id) AS total FROM jm_company WHERE DATE(cmp_created_at) BETWEEN CURDATE() - INTERVAL 3 DAY AND CURDATE()";
        $result = $this->db->query($query)->row_array();
        return $result["total"];
    }

    public function search($query, $start = null, $limit = null)
    {
        $this->reset_condition();
        $this->set_fetch(CompanyModel::$FETCH_ALL);
        $this->set_limit($start, $limit);
        $this->set_query($query);
        $this->set_status("'ACTIVE'");
        return $this->read_query();
    }

    public function update($company, $id)
    {
        $this->load->model("CompanyActivityModel", "company_activity_model");
        $this->company_activity_model->activity_profile();

        $this->db->where(CompanyModel::$primary_key, $id);
        return $this->db->update(CompanyModel::$table_name, $company);
    }

    public function delete($id)
    {
        $this->db->trans_start();

        # remove company task
        $this->load->model("CompanyTaskModel");
        $task = new CompanyTaskModel();
        $task->delete_by_company($id);

        # remove company achievement
        $this->load->model("AchievementModel");
        $achievement = new AchievementModel();
        $achievement->delete_by_company($id);

        # remove people and people photo
        $this->load->model("PeopleModel");
        $people = new PeopleModel();
        $people->delete_by_company($id);

        # remove company activity
        $this->load->model("CompanyActivityModel");
        $activity = new CompanyActivityModel();
        $activity->delete_by_company($id);

        # remove company photo
        $this->load->model("CompanyPhotoModel");
        $photo = new CompanyPhotoModel();
        $photo->delete_by_company($id);

        # remove follower record
        $this->load->model("FollowerModel");
        $follower = new FollowerModel();
        $follower->delete_by_company($id);

        # remove all job, application and bookmark
        $this->load->model("JobModel");
        $job = new JobModel();
        $job->delete_by_company($id);

        # remove all section, application and bookmark
        $this->load->model("CompanySectionModel");
        $job = new CompanySectionModel();
        $job->delete_by_company($id);

        # remove the company itself
        $condition = array(CompanyModel::$primary_key => $id);
        $this->db->delete(CompanyModel::$table_name, $condition);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function delete_by_field($field)
    {
        $condition = array("cmp_field" => $field);
        $companies = $this->db->get_where(CompanyModel::$table_name, $condition)->result_array();

        $this->db->trans_start();

        foreach($companies as $company):
            $this->delete($company[CompanyModel::$primary_key]);
        endforeach;

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function delete_by_size($size)
    {
        $condition = array("cmp_size" => $size);
        $companies = $this->db->get_where(CompanyModel::$table_name, $condition)->result_array();

        $this->db->trans_start();

        foreach($companies as $company):
            $this->delete($company[CompanyModel::$primary_key]);
        endforeach;

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

}