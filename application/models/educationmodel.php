<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 9:53 PM
 */

class EducationModel extends CI_Model
{
    public static $table_name = "jm_education";
    public static $primary_key = "edc_id";

    public static $foreign_employee = "edc_employee";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($education)
    {
        return $this->db->insert(EducationModel::$table_name, $education);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $this->db->order_by("edc_year_begin","desc");
            $result = $this->db->get(EducationModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(EducationModel::$primary_key => $id);
            $result = $this->db->get_where(EducationModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_employee($employee)
    {
        $this->db->order_by("edc_year_begin","desc");
        $condition = array(EducationModel::$foreign_employee => $employee);
        $result = $this->db->get_where(EducationModel::$table_name, $condition);
        return $result->result_array();
    }

    public function update($education, $id)
    {
        $this->db->where(EducationModel::$primary_key, $id);
        return $this->db->update(EducationModel::$table_name, $education);
    }

    public function delete($id, $employee = null)
    {
        $condition = array(EducationModel::$primary_key => $id);
        if($employee != null){
            $condition[EducationModel::$foreign_employee] = $employee;
        }
        return $this->db->delete(EducationModel::$table_name, $condition);
    }

    public function delete_by_employee($employee)
    {
        $condition = array(EducationModel::$foreign_employee => $employee);
        return $this->db->delete(EducationModel::$table_name, $condition);
    }
}