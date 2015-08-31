<?php

/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 7:54 PM
 */
class AchievementModel extends CI_Model
{

    public static $table_name = "jm_achievement";
    public static $primary_key = "ach_id";

    public static $foreign_company = "ach_company";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($achievement)
    {
        $this->load->model("CompanyActivityModel", "company_activity_model");
        $this->company_activity_model->activity_achievement($achievement["ach_award"]);

        return $this->db->insert(AchievementModel::$table_name, $achievement);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(AchievementModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(AchievementModel::$primary_key => $id);
            $result = $this->db->get_where(AchievementModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_company($company)
    {
        $condition = array(AchievementModel::$foreign_company => $company);
        $result = $this->db->get_where(AchievementModel::$table_name, $condition);
        return $result->result_array();
    }

    public function update($achievement, $id, $company = null)
    {
        $condition = array(AchievementModel::$primary_key => $id);
        if($company != null){
            $condition["ach_company"] = $company;
        }
        return $this->db->update(AchievementModel::$table_name, $achievement, $condition);
    }

    public function delete($id, $company = null)
    {
        $condition = array(AchievementModel::$primary_key => $id);
        if($company != null){
            $condition["ach_company"] = $company;
        }
        return $this->db->delete(AchievementModel::$table_name, $condition);
    }

    public function delete_by_company($company)
    {
        $condition = array(AchievementModel::$foreign_company => $company);
        return $this->db->delete(AchievementModel::$table_name, $condition);
    }
}