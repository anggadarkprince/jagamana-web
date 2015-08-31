<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/4/2015
 * Time: 4:51 PM
 */

class PeopleSectionModel extends CI_Model
{
    public static $table_name = "jm_people_section";
    public static $primary_key = "pst_id";

    public static $foreign_people = "pst_people";

    public function create($photo)
    {
        return $this->db->insert(PeopleSectionModel::$table_name, $photo);
    }

    public function create_default($people)
    {
        $data = array(
            "pst_people" => $people,
            "pst_title" => "No Title",
            "pst_description" => "No Description"
        );

        for($i = 9; $i <= 11; $i++)
        {
            $data["pst_section"] = $i;
            $this->create($data);
        }
    }

    public function read($id = null, $people = null)
    {
        if ($id == null) {
            $result = $this->db->get(PeopleSectionModel::$table_name);
            return $result->result_array();
        } else {
            if($people == null){
                $condition = array(PeopleSectionModel::$primary_key => $id);
                $result = $this->db->get_where(PeopleSectionModel::$table_name, $condition);
                return $result->row_array();
            }
            else{
                $condition = array(
                    "pst_section" => $id,
                    "pst_people" => $people
                );
                $result = $this->db->get_where(PeopleSectionModel::$table_name, $condition);
                return $result->row_array();
            }
        }
    }

    public function update($section, $id, $people = null)
    {
        if($people == null){
            $this->db->where(PeopleSectionModel::$primary_key, $id);
            return $this->db->update(PeopleSectionModel::$table_name, $section);
        }
        else{
            $this->db->where("pst_section", $id);
            if($people != null){
                $this->db->where("pst_people", $people);
            }
            return $this->db->update(PeopleSectionModel::$table_name, $section);
        }
    }

    public function delete($id)
    {
        $condition = array(PeopleSectionModel::$primary_key => $id);
        return $this->db->delete(PeopleSectionModel::$table_name, $condition);
    }

    public function delete_by_people($people)
    {
        $condition = array(PeopleSectionModel::$foreign_people => $people);
        return $this->db->delete(PeopleSectionModel::$table_name, $condition);
    }

}