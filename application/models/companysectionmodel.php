<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/4/2015
 * Time: 4:51 PM
 */

class CompanySectionModel extends CI_Model
{
    public static $table_name = "jm_company_section";
    public static $primary_key = "cst_id";

    public static $foreign_company = "cst_company";

    public function create($photo)
    {
        return $this->db->insert(CompanySectionModel::$table_name, $photo);
    }

    public function create_default($company)
    {
        $data = array(
            "cst_company" => $company,
            "cst_title" => "No Title",
            "cst_description" => "No Description"
        );

        for($i = 1; $i <= 8; $i++)
        {
            $data["cst_section"] = $i;
            $this->create($data);
        }
    }

    public function read($id = null, $company = null)
    {
        if ($id == null) {
            $result = $this->db->get(CompanySectionModel::$table_name);
            return $result->result_array();
        } else {
            if($company == null){
                $condition = array(CompanySectionModel::$primary_key => $id);
                $result = $this->db->get_where(CompanySectionModel::$table_name, $condition);
                return $result->row_array();
            }
            else{
                $condition = array(
                    "cst_section" => $id,
                    "cst_company" => $company
                );
                $result = $this->db->get_where(CompanySectionModel::$table_name, $condition);
                return $result->row_array();
            }
        }
    }

    public function update($section, $id, $company = null)
    {
        if($company == null){
            $this->db->where(CompanySectionModel::$primary_key, $id);
            return $this->db->update(CompanySectionModel::$table_name, $section);
        }
        else{
            $this->db->where("cst_section", $id);
            if($company != null){
                $this->db->where("cst_company", $company);
            }
            return $this->db->update(CompanySectionModel::$table_name, $section);
        }
    }

    public function delete($id)
    {
        $condition = array(CompanySectionModel::$primary_key => $id);
        return $this->db->delete(CompanySectionModel::$table_name, $condition);
    }

    public function delete_by_company($company)
    {
        $condition = array(CompanySectionModel::$foreign_company => $company);
        return $this->db->delete(CompanySectionModel::$table_name, $condition);
    }

}