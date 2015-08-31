<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 9:56 PM
 */

class EmployeeActivityModel extends CI_Model
{
    public static $table_name = "jm_employee_activity";
    public static $primary_key = "eac_id";

    public static $foreign_employee = "eac_employee";
    public static $attribute_type = "eac_type";

    private $notification = "NOTIFICATION";
    private $activity = "ACTIVITY";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($activity)
    {
        return $this->db->insert(EmployeeActivityModel::$table_name, $activity);
    }

    public function activity_register($id, $email)
    {
        $data = array(
            "eac_employee" => $id,
            "eac_activity" => "Register",
            "eac_message" => $email." has been registered, let's rock",
            "eac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_activate($id)
    {
        $data = array(
            "eac_employee" => $id,
            "eac_activity" => "Activate",
            "eac_message" => "Your account has been activated at ".date("d F, Y h:m"),
            "eac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_login($id)
    {
        $data = array(
            "eac_employee" => $id,
            "eac_activity" => "Login",
            "eac_message" => "Now login at ".date("d F, Y h:m"),
            "eac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_follow($id, $company, $company_id)
    {
        $data = array(
            "eac_employee" => $id,
            "eac_activity" => "Follow",
            "eac_message" => "You following <a href='".site_url()."company/about/".permalink($company,$company_id).".html'>".$company."</a>, you will follow the updates",
            "eac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_bookmark($job, $job_id)
    {
        $id = $this->session->userdata(UserModel::$SESSION_ID);
        $data = array(
            "eac_employee" => $id,
            "eac_activity" => "Follow",
            "eac_message" => "Job <a href='".site_url()."job/detail/".permalink($job,$job_id).".html'>".$job."</a> saved as bookmark",
            "eac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_apply($job, $job_id)
    {
        $id = $this->session->userdata(UserModel::$SESSION_ID);
        $data = array(
            "eac_employee" => $id,
            "eac_activity" => "Apply",
            "eac_message" => "You applying job <a href='".site_url()."job/detail/".permalink($job,$job_id).".html'>".$job."</a>",
            "eac_type" => $this->activity
        );
        $this->create($data);
    }

    public function activity_setting()
    {
        $id = $this->session->userdata(UserModel::$SESSION_ID);
        $data = array(
            "eac_employee" => $id,
            "eac_activity" => "Setting",
            "eac_message" => " Setting has been updated at ".date("d F, Y h:m"),
            "eac_type" => $this->activity
        );
        $this->create($data);
    }

    public function notification_confirmed($id, $job, $job_id)
    {
        $data = array(
            "eac_employee" => $id,
            "eac_activity" => "Accept",
            "eac_message" => "Your application <span class='label label-success'>ACCEPTED</span> for job <a href='".site_url()."job/detail/".permalink($job,$job_id).".html'>".$job."</a>",
            "eac_type" => $this->notification
        );
        $this->create($data);
    }

    public function notification_rejected($id, $job, $job_id)
    {
        $data = array(
            "eac_employee" => $id,
            "eac_activity" => "Reject",
            "eac_message" => "Your application <span class='label label-danger'>REJECTED</span> for job <a href='".site_url()."job/detail/".permalink($job,$job_id).".html'>".$job."</a>",
            "eac_type" => $this->notification
        );
        $this->create($data);
    }

    public function notification_commented($id, $thread, $thread_id, $name)
    {
        $data = array(
            "eac_employee" => $id,
            "eac_activity" => "Comment",
            "eac_message" => "Your thread <a href='".site_url()."forum/thread/".permalink($thread,$thread_id).".html'>".$thread."</a> commented by ".$name,
            "eac_type" => $this->notification
        );
        $this->create($data);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(EmployeeActivityModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(EmployeeActivityModel::$primary_key => $id);
            $result = $this->db->get_where(EmployeeActivityModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_employee($employee)
    {
        $this->db->select("*");
        $this->db->where(EmployeeActivityModel::$foreign_employee, $employee);
        $this->db->order_by("eac_created_at", "desc");

        $result = $this->db->get(EmployeeActivityModel::$table_name);
        return $result->result_array();
    }

    public function read_by_notification($employee)
    {
        $this->db->select("*");
        $this->db->where(EmployeeActivityModel::$foreign_employee, $employee);
        $this->db->where(EmployeeActivityModel::$attribute_type, $this->notification);
        $this->db->order_by("eac_created_at", "desc");
        $this->db->limit(20, 0);

        $result = $this->db->get(EmployeeActivityModel::$table_name);
        return $result->result_array();
    }

    public function read_by_activity($employee)
    {
        $this->db->select("*");
        $this->db->where(EmployeeActivityModel::$foreign_employee, $employee);
        $this->db->where(EmployeeActivityModel::$attribute_type, $this->activity);
        $this->db->order_by("eac_created_at", "desc");
        $this->db->limit(15, 0);

        $result = $this->db->get(EmployeeActivityModel::$table_name);
        return $result->result_array();
    }

    public function update($activity, $id)
    {
        return $this->db->update(EmployeeActivityModel::$table_name, $activity)
            ->where(EmployeeActivityModel::$primary_key, $id);
    }

    public function delete($id)
    {
        $condition = array(EmployeeActivityModel::$primary_key => $id);
        return $this->db->delete(EmployeeActivityModel::$table_name, $condition);
    }

    public function delete_by_employee($employee)
    {
        $condition = array(EmployeeActivityModel::$foreign_employee => $employee);
        return $this->db->delete(EmployeeActivityModel::$table_name, $condition);
    }
}