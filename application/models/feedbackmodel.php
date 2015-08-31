<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 7/29/2015
 * Time: 5:05 PM
 */

class FeedbackModel extends CI_Model
{
    public static $table_name = "jm_feedback";
    public static $primary_key = "fdb_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($feedback)
    {
        return $this->db->insert(FeedbackModel::$table_name, $feedback);
    }

    public function read($type = null)
    {
        $this->db->where("fdb_type", $type);
        $this->db->order_by("fdb_created_at","desc");
        $result = $this->db->get(FeedbackModel::$table_name);
        return $result->result_array();
    }

    public function update($feedback, $id)
    {
        $this->db->where(FeedbackModel::$primary_key, $id);
        return $this->db->update(FeedbackModel::$table_name, $feedback);
    }

    public function delete($id)
    {
        $condition = array(FeedbackModel::$primary_key => $id);
        return $this->db->delete(FeedbackModel::$table_name, $condition);
    }
}