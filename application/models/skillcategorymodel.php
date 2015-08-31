<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:19 PM
 */

class SkillCategoryModel extends CI_Model
{
    public static $table_name = "jm_skill_category";
    public static $primary_key = "sct_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($type)
    {
        return $this->db->insert(SkillCategoryModel::$table_name, $type);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(SkillCategoryModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(SkillCategoryModel::$primary_key => $id);
            $result = $this->db->get_where(SkillCategoryModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_employee($employee)
    {
        $query = "
          SELECT
          DISTINCT
            sct_id,
            sct_category

            FROM jm_skill_category

            INNER JOIN jm_skill
              ON sct_id = skl_category

            INNER JOIN jm_employee
              ON skl_employee = emp_id

            WHERE emp_id = '$employee'
        ";

        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function update($category, $id)
    {
        $this->db->where(SkillCategoryModel::$primary_key, $id);
        return $this->db->update(SkillCategoryModel::$table_name, $category);
    }

    public function delete($id)
    {
        $this->db->trans_start();

        # remove all skills related by skill category
        $skill = new SkillModel();
        $skill->delete_by_category($id);

        # then remove the skill category
        $condition = array(SkillCategoryModel::$primary_key => $id);
        $this->db->delete(SkillCategoryModel::$table_name, $condition);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }


}