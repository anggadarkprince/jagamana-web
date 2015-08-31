<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:18 PM
 */

class SkillModel extends CI_Model
{
    public static $table_name = "jm_skill";
    public static $primary_key = "skl_id";

    public static $foreign_employee = "skl_employee";
    public static $foreign_category = "skl_category";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($photo)
    {
        return $this->db->insert(SkillModel::$table_name, $photo);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(SkillModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(SkillModel::$primary_key => $id);
            $result = $this->db->get_where(SkillModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_employee($employee)
    {
        $this->load->model("SkillCategoryModel", "skill_category_model");
        $categories = $this->skill_category_model->read_by_employee($employee);

        $data = array();
        foreach($categories as $category):
            $category_id = $category["sct_id"];

            $skill = $this->read_by_both($employee, $category_id);
            $row = array(
                "category" => $category["sct_category"],
                "skill" => $skill
            );

            array_push($data,$row);
        endforeach;

        return $data;
    }

    public function read_by_category($category)
    {
        $condition = array(SkillModel::$foreign_category => $category);
        $result = $this->db->get_where(SkillModel::$table_name, $condition);
        return $result->result_array();
    }

    public function read_by_both($employee, $category)
    {
        $condition = array(SkillModel::$foreign_employee => $employee, SkillModel::$foreign_category => $category);
        $result = $this->db->get_where(SkillModel::$table_name, $condition);
        return $result->result_array();
    }

    public function update($photo, $id)
    {
        return $this->db->update(SkillModel::$table_name, $photo)
            ->where(SkillModel::$primary_key, $id);
    }

    public function delete($id, $employee = null)
    {
        $condition = array(SkillModel::$primary_key => $id);
        if($employee != null){
            $condition[SkillModel::$foreign_employee] = $employee;
        }
        return $this->db->delete(SkillModel::$table_name, $condition);
    }

    public function delete_by_category($category)
    {
        $condition = array(SkillModel::$foreign_category => $category);
        return $this->db->delete(SkillModel::$table_name, $condition);
    }

    public function delete_by_employee($employee)
    {
        $condition = array(SkillModel::$foreign_employee => $employee);
        return $this->db->delete(SkillModel::$table_name, $condition);
    }


}