<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/4/2015
 * Time: 4:42 PM
 */

class SectionModel extends CI_Model
{
    public static $table_name = "jm_section";
    public static $primary_key = "sct_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($photo)
    {
        return $this->db->insert(SectionModel::$table_name, $photo);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(SectionModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(SectionModel::$primary_key => $id);
            $result = $this->db->get_where(SectionModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function update($photo, $id)
    {
        return $this->db->update(SectionModel::$table_name, $photo)
            ->where(SectionModel::$primary_key, $id);
    }

    public function delete($id)
    {
        $condition = array(SectionModel::$primary_key => $id);
        return $this->db->delete(SectionModel::$table_name, $condition);
    }
}