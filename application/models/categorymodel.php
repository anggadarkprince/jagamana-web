<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 8:44 PM
 */

class CategoryModel extends CI_Model
{

    public static $table_name = "jm_category";
    public static $primary_key = "ctg_id";

    public static $FETCH_ROW = "fetch_row";
    public static $FETCH_ALL = "fetch_all";

    private $thread_fetch = "fetch_all";
    private $thread_condition = "";
    private $thread_limit = "";

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

    public function set_id($id)
    {
        $this->thread_condition .= " AND category_id = $id";
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

    public function create($category)
    {
        return $this->db->insert(CategoryModel::$table_name, $category);
    }

    public function read($start = null, $limit = null)
    {
        $this->reset_condition();
        $this->set_fetch(CategoryModel::$FETCH_ALL);
        $this->set_limit($start, $limit);
        return $this->read_query();
    }

    public function read_by_id($id)
    {
        $this->reset_condition();
        $this->set_fetch(CategoryModel::$FETCH_ROW);
        $this->set_id($id);
        return $this->read_query();
    }

    public function read_query()
    {
        $query = "SELECT * FROM jm_view_category $this->thread_condition $this->thread_limit";

        $result = $this->db->query($query);

        $row = $result->num_rows();

        if($this->thread_fetch == CategoryModel::$FETCH_ROW){
            $data = $result->row_array();
            $data["permalink"] = permalink($data["category"],$data["category_id"], false, true);

        }
        else{
            $data = $result->result_array();
            for($i = 0; $i < count($data); $i++){
                $data[$i]["permalink"] = permalink($data[$i]["category"],$data[$i]["category_id"], false, true);
            }
        }

        return $data;
    }

    public function update($category, $id)
    {
        $this->db->where(CategoryModel::$primary_key, $id);
        return $this->db->update(CategoryModel::$table_name, $category);
    }

    public function delete($id)
    {
        $condition = array(CategoryModel::$primary_key => $id);
        return $this->db->delete(CategoryModel::$table_name, $condition);
    }
}