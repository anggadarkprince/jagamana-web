<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 9:12 PM
 */

class CompanyActivityModel extends CI_Model{

    public static $table_name = "jm_company_activity";
    public static $primary_key = "cac_id";

    public static $foreign_company = "cac_company";
    public static $attribute_type = "cac_type";

    private $notification = "NOTIFICATION";
    private $activity = "ACTIVITY";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($activity)
    {
        return $this->db->insert(CompanyActivityModel::$table_name, $activity);
    }

    public function activity_register($id, $email){
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "Register",
            "cac_message" => $email." has been registered, let's rock",
            "cac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_activate($id)
    {
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "Activate",
            "cac_message" => "Your account has been activated at ".date("d F, Y h:m"),
            "cac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_login($id)
    {
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "Login",
            "cac_message" => "Now login at ".date("d F, Y h:m"),
            "cac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_job($job)
    {
        $id = $this->session->userdata(UserModel::$SESSION_ID);
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "Job",
            "cac_message" => "You have create the job $job, you will wait the applicants",
            "cac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_people($people)
    {
        $id = $this->session->userdata(UserModel::$SESSION_ID);
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "People",
            "cac_message" => "You have create company people $people",
            "cac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_achievement($achievement)
    {
        $id = $this->session->userdata(UserModel::$SESSION_ID);
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "Achievement",
            "cac_message" => "$achievement has been added",
            "cac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_profile()
    {
        $id = $this->session->userdata(UserModel::$SESSION_ID);
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "Profile",
            "cac_message" => " Profile has been updated at ".date("d F, Y h:m"),
            "cac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_office()
    {
        $id = $this->session->userdata(UserModel::$SESSION_ID);
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "Office",
            "cac_message" => " Office has been updated at ".date("d F, Y h:m"),
            "cac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_setting()
    {
        $id = $this->session->userdata(UserModel::$SESSION_ID);
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "Setting",
            "cac_message" => " Setting has been updated at ".date("d F, Y h:m"),
            "cac_type" => $this->activity
        );
        $this->create($data);
    }

    public function notification_followed($id, $employee, $employee_id)
    {
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "Follow",
            "cac_message" => "Your have followed by <a href='".site_url()."account/detail/".permalink($employee,$employee_id).".html'>".$employee."</a>",
            "cac_type" => $this->notification
        );
        $this->create($data);
    }

    public function notification_applied($id, $employee, $employee_id, $job, $job_id)
    {
        $data = array(
            "cac_company" => $id,
            "cac_activity" => "Applied",
            "cac_message" => "Your job <a href='".site_url()."job/detail/".permalink($job,$job_id).".html'>".$job."</a> applied by <a href='".site_url()."account/detail/".permalink($employee,$employee_id).".html'>".$employee."</a>",
            "cac_type" => $this->notification
        );
        $this->create($data);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(CompanyActivityModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(CompanyActivityModel::$primary_key => $id);
            $result = $this->db->get_where(CompanyActivityModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_company($company)
    {
        $this->db->select("*");
        $this->db->where(CompanyActivityModel::$foreign_company, $company);
        $this->db->order_by("cac_created_at", "desc");

        $result = $this->db->get(CompanyActivityModel::$table_name);
        return $result->result_array();
    }

    public function read_by_notification($company)
    {
        $this->db->select("*");
        $this->db->where(CompanyActivityModel::$foreign_company, $company);
        $this->db->where(CompanyActivityModel::$attribute_type, $this->notification);
        $this->db->order_by("cac_created_at", "desc");
        $this->db->limit(20, 0);

        $result = $this->db->get(CompanyActivityModel::$table_name);
        return $result->result_array();
    }

    public function read_by_activity($company)
    {
        $this->db->select("*");
        $this->db->where(CompanyActivityModel::$foreign_company, $company);
        $this->db->where(CompanyActivityModel::$attribute_type, $this->activity);
        $this->db->order_by("cac_created_at", "desc");
        $this->db->limit(15, 0);

        $result = $this->db->get(CompanyActivityModel::$table_name);
        return $result->result_array();
    }

    public function update($activity, $id)
    {
        $this->db->where(CompanyActivityModel::$primary_key, $id);
        return $this->db->update(CompanyActivityModel::$table_name, $activity);
    }

    public function delete($id)
    {
        $condition = array(CompanyActivityModel::$primary_key => $id);
        return $this->db->delete(CompanyActivityModel::$table_name, $condition);
    }

    public function delete_by_company($company)
    {
        $condition = array(CompanyActivityModel::$foreign_company => $company);
        return $this->db->delete(CompanyActivityModel::$table_name, $condition);
    }

}