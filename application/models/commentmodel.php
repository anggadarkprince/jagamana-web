<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 8:53 PM
 */

class CommentModel extends CI_Model
{
    public static $table_name = "jm_comment";
    public static $primary_key = "cmt_id";

    public static $foreign_thread = "cmt_thread";
    public static $foreign_email = "cmt_email";

    private $thread_condition;
    private $thread_limit;

    public function __construct()
    {
        parent::__construct();
    }

    public function reset_condition()
    {
        $this->thread_condition = "WHERE 1";
        $this->thread_limit = "";
    }

    public function set_id($id)
    {
        $this->thread_condition .= " AND cmt_id = $id";
    }

    public function set_thread($thread = null)
    {
        $this->thread_condition .= " AND cmt_thread = $thread";
    }

    public function set_email($email = null)
    {
        $this->thread_condition .= " AND cmt_email = $email";
    }

    public function create($comment)
    {
        $this->load->model("ThreadModel","thread_model");
        $thread = $this->thread_model->read_by_id($comment["cmt_thread"]);

        $this->load->model("EmployeeActivityModel", "employee_activity_model");
        $this->employee_activity_model->notification_commented($thread["author_id"], $thread["title"], $thread["title_id"], $comment["cmt_name"]);

        return $this->db->insert(CommentModel::$table_name, $comment);
    }

    public function read()
    {
        $this->reset_condition();
        return $this->read_query();
    }

    public function read_by_id($id)
    {
        $this->reset_condition();
        $this->set_id($id);
        return $this->read_query();
    }

    public function read_by_thread($thread)
    {
        $this->reset_condition();
        $this->set_thread($thread);
        return $this->read_query();
    }

    public function read_by_email($email)
    {
        $this->reset_condition();
        $this->set_email($email);
        return $this->read_query();
    }

    public function read_query()
    {
        $query = "
          SELECT
            cmt_id AS comment_id,
            cmt_thread AS thread_id,
            thr_title AS thread,
            cmt_name AS name,
            cmt_email AS email,
            emp_id AS employee_id,
            IFNULL(emp_avatar,'noimage.jpg') AS employee_avatar,
            cmt_comment AS comment,
            cmt_created_at AS created_at,
            cmt_updated_at AS updated_at

            FROM jm_comment

            INNER JOIN jm_thread
              ON cmt_thread = thr_id

            LEFT JOIN jm_employee
              ON cmt_email = emp_email

            $this->thread_condition

            ORDER BY cmt_created_at DESC
        ";

        $result = $this->db->query($query);

        return $result->result_array();
    }

    public function update($comment, $id)
    {
        return $this->db->update(CommentModel::$table_name, $comment)
            ->where(CommentModel::$primary_key, $id);
    }

    public function delete($id)
    {
        $condition = array(CommentModel::$primary_key => $id);
        return $this->db->delete(CommentModel::$table_name, $condition);
    }

    public function delete_by_thread($thread)
    {
        $condition = array(CommentModel::$foreign_thread => $thread);
        return $this->db->delete(CommentModel::$table_name, $condition);
    }

    public function delete_by_email($email)
    {
        $condition = array(CommentModel::$foreign_email => $email);
        return $this->db->delete(CommentModel::$table_name, $condition);
    }

}