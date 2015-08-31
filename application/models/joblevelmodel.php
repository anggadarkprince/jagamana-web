<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:17 PM
 */

class JobLevelModel extends CI_Model
{
    public static $table_name = "jm_job_level";
    public static $primary_key = "jlv_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($level)
    {
        return $this->db->insert(JobLevelModel::$table_name, $level);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(JobLevelModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(JobLevelModel::$primary_key => $id);
            $result = $this->db->get_where(JobLevelModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function update($level, $id)
    {
        $this->db->where(JobLevelModel::$primary_key, $id);
        return $this->db->update(JobLevelModel::$table_name, $level);
    }

    public function delete($id)
    {
        $this->db->trans_start();

        # delete company related by field
        $this->load->model("JobModel");
        $job =  new JobModel();
        $job->delete_by_level($id);

        # remove the field itself
        $condition = array(JobLevelModel::$primary_key => $id);
        $this->db->delete(JobLevelModel::$table_name, $condition);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}