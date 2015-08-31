<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 9:43 PM
 */

class CompanyPhotoModel extends CI_Model
{

    public static $table_name = "jm_company_photo";
    public static $primary_key = "cph_id";

    public static $foreign_company = "cph_company";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($photo)
    {
        return $this->db->insert(CompanyPhotoModel::$table_name, $photo);
    }

    public function create_default($company)
    {
        $data = array(
            "cph_company" => $company,
            "cph_title" => "default image",
            "cph_type" => "PRIMARY");
        $this->create($data);

        for($i = 0; $i < 3; $i++){
            $data = array(
                "cph_company" => $company,
                "cph_title" => "default image",
                "cph_type" => "SECONDARY");
            $this->create($data);
        }
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(CompanyPhotoModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(CompanyPhotoModel::$primary_key => $id);
            $result = $this->db->get_where(CompanyPhotoModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_company($company, $type = null)
    {
        $condition = array(CompanyPhotoModel::$foreign_company => $company);
        if($type != null){
            $condition["cph_type"] = $type;
        }
        $result = $this->db->get_where(CompanyPhotoModel::$table_name, $condition);
        if($type=="PRIMARY"){
            return $result->row_array();
        }
        return $result->result_array();
    }

    public function update($photo, $id, $company = null)
    {
        $this->load->model("CompanyActivityModel", "company_activity_model");
        $this->company_activity_model->activity_office();

        $this->db->where(CompanyPhotoModel::$primary_key, $id);
        if($company != null){
            $this->db->where(CompanyPhotoModel::$foreign_company, $company);
        }
        return $this->db->update(CompanyPhotoModel::$table_name, $photo);
    }

    public function delete($id, $company = null)
    {
        $condition = array(CompanyPhotoModel::$primary_key => $id);
        if($company != null){
            $condition[CompanyPhotoModel::$foreign_company] = $company;
        }
        return $this->db->delete(CompanyPhotoModel::$table_name, $condition);
    }

    public function delete_by_company($company)
    {
        $condition = array(CompanyPhotoModel::$foreign_company => $company);
        return $this->db->delete(CompanyPhotoModel::$table_name, $condition);
    }
}