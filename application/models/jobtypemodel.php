<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:18 PM
 */

class JobTypeModel extends CI_Model
{
    public static $table_name = "jm_job_type";
    public static $primary_key = "jty_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($type)
    {
        return $this->db->insert(JobTypeModel::$table_name, $type);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(JobTypeModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(JobTypeModel::$primary_key => $id);
            $result = $this->db->get_where(JobTypeModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function update($type, $id)
    {
        $this->db->where(JobTypeModel::$primary_key, $id);
        return $this->db->update(JobTypeModel::$table_name, $type);
    }

    public function delete($id)
    {
        $condition = array(JobTypeModel::$primary_key => $id);
        return $this->db->delete(JobTypeModel::$table_name, $condition);
    }
}