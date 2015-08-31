<?php

/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 8:38 PM
 */
class BookmarkModel extends CI_Model
{
    public static $table_name = "jm_bookmark";
    public static $view_name = "jm_view_bookmark";
    public static $primary_key = "bmk_id";
    public static $view_key = "bookmark_id";

    public static $foreign_job = "bmk_job";
    public static $foreign_employee = "bmk_employee";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($bookmark)
    {
        $this->load->model("JobModel","job_model");
        $job = $this->job_model->read_by_id($bookmark["bmk_job"]);

        $this->load->model("EmployeeActivityModel", "employee_activity_model");
        $this->employee_activity_model->activity_bookmark($job["vacancy"], $job["job_id"]);

        return $this->db->insert(BookmarkModel::$table_name, $bookmark);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(BookmarkModel::$view_name);
            return $result->result_array();
        } else {
            $condition = array(BookmarkModel::$view_key => $id);
            $result = $this->db->get_where(BookmarkModel::$view_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_employee($employee)
    {
        $query = "
          SELECT
            bookmark_id,
            jm_view_job.*
            FROM jm_view_bookmark
            LEFT JOIN jm_view_job
              ON jm_view_bookmark.job_id = jm_view_job.job_id
            WHERE employee_id = '$employee'
              ";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function read_by_job($job)
    {
        $condition = array(BookmarkModel::$foreign_job => $job);
        $result = $this->db->get_where(BookmarkModel::$table_name, $condition);
        return $result->result_array();
    }

    public function get_statistic_saved($employee)
    {
        $this->db->where(BookmarkModel::$foreign_employee, $employee);
        $this->db->from(BookmarkModel::$table_name);
        return $this->db->count_all_results();
    }

    public function update($bookmark, $id)
    {
        $this->db->where(BookmarkModel::$primary_key, $id);
        return $this->db->update(BookmarkModel::$table_name, $bookmark);
    }

    public function delete($id, $employee = null)
    {
        if($employee != null){
            $condition[BookmarkModel::$foreign_job] = $id;
            $condition[BookmarkModel::$foreign_employee] = $employee;
        }
        else{
            $condition = array(BookmarkModel::$primary_key => $id);
        }
        return $this->db->delete(BookmarkModel::$table_name, $condition);
    }

    public function delete_by_employee($employee)
    {
        $condition = array(BookmarkModel::$foreign_employee => $employee);
        return $this->db->delete(BookmarkModel::$table_name, $condition);
    }

    public function delete_by_job($job)
    {
        $condition = array(BookmarkModel::$foreign_job => $job);
        return $this->db->delete(BookmarkModel::$table_name, $condition);
        /*
        $bookmarks = $this->read_by_job($job);

        $this->db->trans_start();

        foreach($bookmarks as $bookmark):
            $this->update(array("bmk_job" => null), $bookmark[BookmarkModel::$primary_key]);
        endforeach;

        $this->db->trans_complete();

        return $this->db->trans_status();
        */
    }
}