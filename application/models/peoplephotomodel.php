<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:18 PM
 */

class PeoplePhotoModel extends CI_Model
{
    public static $table_name = "jm_people_photo";
    public static $primary_key = "pph_id";

    public static $foreign_people = "pph_people";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($photo)
    {
        return $this->db->insert(PeoplePhotoModel::$table_name, $photo);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(PeoplePhotoModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(PeoplePhotoModel::$primary_key => $id);
            $result = $this->db->get_where(PeoplePhotoModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_people($people)
    {
        $condition = array(PeoplePhotoModel::$foreign_people => $people);
        $result = $this->db->get_where(PeoplePhotoModel::$table_name, $condition);
        return $result->result_array();
    }

    public function update($photo, $id)
    {
        $this->db->where(PeoplePhotoModel::$primary_key, $id);
        return $this->db->update(PeoplePhotoModel::$table_name, $photo);
    }

    public function delete($id)
    {
        $condition = array(PeoplePhotoModel::$primary_key => $id);
        return $this->db->delete(PeoplePhotoModel::$table_name, $condition);
    }

    public function delete_by_people($people)
    {
        $condition = array(PeoplePhotoModel::$foreign_people => $people);
        return $this->db->delete(PeoplePhotoModel::$table_name, $condition);
    }
}