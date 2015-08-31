<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:13 PM
 */

class FollowerModel extends CI_Model
{
    public static $table_name = "jm_follower";
    public static $primary_key = "flw_id";

    public static $foreign_employee = "flw_employee";
    public static $foreign_company = "flw_company";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($follower)
    {
        $this->load->model("CompanyModel","company_model");
        $company = $this->company_model->read_by_id($follower["flw_company"]);

        $this->load->model("EmployeeActivityModel", "employee_activity_model");
        $this->employee_activity_model->activity_follow($follower["flw_employee"], $company["cmp_name"], $company["cmp_id"]);

        $this->load->model("EmployeeModel","employee_model");
        $employee = $this->employee_model->read($follower["flw_employee"]);

        $this->load->model("CompanyActivityModel", "company_activity_model");
        $this->company_activity_model->notification_followed($company["cmp_id"], $employee["emp_name"], $employee["emp_id"]);

        return $this->db->insert(FollowerModel::$table_name, $follower);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(FollowerModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(FollowerModel::$primary_key => $id);
            $result = $this->db->get_where(FollowerModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_employee($employee)
    {
        $query = "
          SELECT
            follower_id,
            jm_view_company.*
            FROM jm_view_follower
            LEFT JOIN jm_view_company
              ON jm_view_follower.company_id = jm_view_company.company_id
            WHERE employee_id = '$employee'
        ";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function read_by_company($company)
    {
        $result = $this->db->get_where("jm_view_follower", array("company_id"=>$company));
        return $result->result_array();
    }

    public function get_statistic_following($employee)
    {
        $this->db->where(FollowerModel::$foreign_employee, $employee);
        $this->db->from(FollowerModel::$table_name);
        return $this->db->count_all_results();
    }

    public function get_statistic_follower($company)
    {
        $this->db->where(FollowerModel::$foreign_company, $company);
        $this->db->from(FollowerModel::$table_name);
        return $this->db->count_all_results();
    }

    public function update($follower, $id)
    {
        $this->db->where(FollowerModel::$primary_key, $id);
        return $this->db->update(FollowerModel::$table_name, $follower);
    }

    public function delete($company, $employee)
    {
        $condition = array(
            FollowerModel::$foreign_company => $company,
            FollowerModel::$foreign_employee => $employee
        );
        return $this->db->delete(FollowerModel::$table_name, $condition);
    }

    public function delete_by_company($company)
    {
        $condition = array(FollowerModel::$foreign_company => $company);
        return $this->db->delete(FollowerModel::$table_name, $condition);
    }

    public function delete_by_employee($employee)
    {
        $condition = array(FollowerModel::$foreign_employee => $employee);
        return $this->db->delete(FollowerModel::$table_name, $condition);
    }
}