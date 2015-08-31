<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 9:51 PM
 */

class CompanyTaskModel extends CI_Model
{
    public static $table_name = "jm_company_task";
    public static $primary_key = "cts_id";

    public static $foreign_company = "cts_company";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($task)
    {
        return $this->db->insert(CompanyTaskModel::$table_name, $task);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(CompanyTaskModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(CompanyTaskModel::$primary_key => $id);
            $result = $this->db->get_where(CompanyTaskModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_company($company)
    {
        $condition = array(CompanyTaskModel::$foreign_company => $company);
        $result = $this->db->get_where(CompanyTaskModel::$table_name, $condition);
        return $result->result_array();
    }

    public function update($task, $id, $company = null)
    {
        $this->db->where(CompanyTaskModel::$primary_key, $id);
        if($company != null){
            $this->db->where("cts_company", $company);
        }
        return $this->db->update(CompanyTaskModel::$table_name, $task);
    }

    public function delete($id, $company = null)
    {
        $condition = array(CompanyTaskModel::$primary_key => $id);
        if($company != null){
            $condition["cts_company"] = $company;
        }
        return $this->db->delete(CompanyTaskModel::$table_name, $condition);
    }

    public function delete_by_company($company)
    {
        $condition = array(CompanyTaskModel::$foreign_company => $company);
        return $this->db->delete(CompanyTaskModel::$table_name, $condition);
    }
}