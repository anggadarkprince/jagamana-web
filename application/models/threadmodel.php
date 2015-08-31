<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:19 PM
 */

class ThreadModel extends CI_Model
{
    public static $table_name = "jm_thread";
    public static $primary_key = "thr_id";

    public static $foreign_author = "thr_author";
    public static $foreign_category = "thr_category";

    public static $FETCH_ROW = "fetch_row";
    public static $FETCH_ALL = "fetch_all";

    private $thread_fetch = "fetch_all";
    private $thread_condition;
    private $thread_limit;
    private $thread_total;

    public function __construct()
    {
        parent::__construct();
    }

    public function reset_condition()
    {
        $this->thread_condition = "WHERE 1";
        $this->thread_limit = "";
    }

    public function set_fetch($fetch)
    {
        $this->thread_fetch = $fetch;
    }

    public function set_limit($start = 0, $limit = 10)
    {
        if(($start != null || $start >= 0) && ($limit != null && $limit > 0))
        {
            if($start == ""){
                $start = 0;
            }
            $this->thread_limit .= " LIMIT $start,$limit";
        }
    }

    public function set_id($id)
    {
        $this->thread_condition .= " AND thread_id = $id";
    }

    public function set_status($status = "PUBLISH")
    {
        if($status != null){
            $this->thread_condition .= " AND status = '$status'";
        }
    }

    public function set_author($author = null)
    {
        if($author != null){
            $this->thread_condition .= " AND author_id = '$author'";
        }
    }

    public function set_category($category = null)
    {
        if($category != null){
            $this->thread_condition .= " AND category_id = $category";
        }
    }

    public function get_thread_total()
    {
        return $this->thread_total;
    }

    public function create($thread)
    {
        return $this->db->insert(ThreadModel::$table_name, $thread);
    }

    public function read($start = null, $limit = null, $status = null)
    {
        $this->reset_condition();
        $this->set_fetch(ThreadModel::$FETCH_ALL);
        $this->set_limit($start, $limit);
        $this->set_status($status);
        return $this->read_query();
    }

    public function read_by_id($id)
    {
        $this->reset_condition();
        $this->set_fetch(ThreadModel::$FETCH_ROW);
        $this->set_id($id);
        return $this->read_query();
    }

    public function read_by_author($start = null, $limit = null, $author = null, $status = null)
    {
        $this->reset_condition();
        $this->set_fetch(ThreadModel::$FETCH_ALL);
        $this->set_limit($start, $limit);
        $this->set_author($author);
        $this->set_status($status);
        return $this->read_query();
    }

    public function read_by_category($start = null, $limit = null, $category = null, $status = null)
    {
        $this->reset_condition();
        $this->set_fetch(ThreadModel::$FETCH_ALL);
        $this->set_limit($start, $limit);
        $this->set_category($category);
        $this->set_status($status);
        return $this->read_query();
    }

    public function read_query()
    {
        $query = "SELECT * FROM jm_view_thread $this->thread_condition $this->thread_limit";

        $result = $this->db->query($query);

        $this->thread_total = $result->num_rows();

        if($this->thread_fetch == ThreadModel::$FETCH_ROW){
            $data = $result->row_array();
            $data["permalink"] = permalink($data["title"],$data["thread_id"]);
            $data["permalink_category"] = permalink($data["category"],$data["category_id"], false, true);
        }
        else{
            $data = $result->result_array();
            for($i = 0; $i < count($data); $i++){
                $data[$i]["permalink"] = permalink($data[$i]["title"],$data[$i]["thread_id"]);
                $data[$i]["permalink_category"] = permalink($data[$i]["category"],$data[$i]["category_id"], false, true);
            }
        }

        return $data;
    }

    public function update($thread, $id)
    {
        $this->db->where(ThreadModel::$primary_key, $id);
        return $this->db->update(ThreadModel::$table_name, $thread);
    }

    public function updated_reader_total($id)
    {
        $result = $this->db->query("UPDATE jm_thread SET thr_readed=thr_readed+1 WHERE thr_id = $id");
        return $result;
    }

    public function delete($id)
    {
        $this->load->model("CommentModel");
        $this->db->trans_start();

        # remove all comments related by thread
        $comment = new CommentModel();
        $comment->delete_by_thread($id);

        # then remove the thread
        $condition = array(ThreadModel::$primary_key => $id);
        $this->db->delete(ThreadModel::$table_name, $condition);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function delete_by_employee($employee)
    {
        # get all thread related author/employee
        $thread = $this->read_by_author($employee);

        $this->load->model("CommentModel");
        $comment = new CommentModel();

        foreach($thread as $post):

            # delete all comments
            $comment->delete_by_thread($post["thread_id"]);

        endforeach;

        $condition = array(ThreadModel::$foreign_author => $employee);
        return $this->db->delete(ThreadModel::$table_name, $condition);
    }

    public function delete_by_category($category)
    {
        $condition = array(ThreadModel::$foreign_category => $category);
        return $this->db->delete(ThreadModel::$table_name, $condition);
    }
}