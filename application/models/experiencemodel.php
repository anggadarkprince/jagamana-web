<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:09 PM
 */

class ExperienceModel extends CI_Model
{
    public static $table_name = "jm_experience";
    public static $primary_key = "exp_id";

    public static $foreign_employee = "exp_employee";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($experience)
    {
        return $this->db->insert(ExperienceModel::$table_name, $experience);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $this->db->order_by("exp_year_begin","desc");
            $result = $this->db->get(ExperienceModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(ExperienceModel::$primary_key => $id);
            $result = $this->db->get_where(ExperienceModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_employee($employee)
    {
        $this->db->order_by("exp_year_begin","desc");
        $condition = array(ExperienceModel::$foreign_employee => $employee);
        $result = $this->db->get_where(ExperienceModel::$table_name, $condition);
        return $result->result_array();
    }

    public function update($experience, $id)
    {
        $this->db->where(ExperienceModel::$primary_key, $id);
        return $this->db->update(ExperienceModel::$table_name, $experience);
    }

    public function delete($id, $employee = null)
    {
        $condition = array(ExperienceModel::$primary_key => $id);
        if($employee != null){
            $condition[ExperienceModel::$foreign_employee] = $employee;
        }
        return $this->db->delete(ExperienceModel::$table_name, $condition);
    }

    public function delete_by_employee($employee)
    {
        $condition = array(ExperienceModel::$foreign_employee => $employee);
        return $this->db->delete(ExperienceModel::$table_name, $condition);
    }
}