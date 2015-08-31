<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:18 PM
 */

class JobFieldModel extends CI_Model
{
    public static $table_name = "jm_job_field";
    public static $primary_key = "jfd_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($type)
    {
        return $this->db->insert(JobFieldModel::$table_name, $type);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->query("SELECT jm_job_field.*, COUNT(job_id) AS job FROM jm_job_field LEFT JOIN jm_job ON jfd_id = job_field GROUP BY jfd_id ORDER BY job DESC");
            return $result->result_array();
        } else {
            $condition = array(JobFieldModel::$primary_key => $id);
            $result = $this->db->get_where(JobFieldModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function update($type, $id)
    {
        $this->db->where(JobFieldModel::$primary_key, $id);
        return $this->db->update(JobFieldModel::$table_name, $type);
    }

    public function delete($id)
    {
        $this->db->trans_start();

        # delete company related by field
        $this->load->model("JobModel");
        $job =  new JobModel();
        $job->delete_by_field($id);

        # remove the field itself
        $condition = array(JobFieldModel::$primary_key => $id);
        $this->db->delete(JobFieldModel::$table_name, $condition);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}
