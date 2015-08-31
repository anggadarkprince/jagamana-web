<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 9:47 PM
 */

class CompanySizeModel extends CI_Model
{
    public static $table_name = "jm_company_size";
    public static $primary_key = "csz_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($size)
    {
        return $this->db->insert(CompanySizeModel::$table_name, $size);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(CompanySizeModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(CompanySizeModel::$primary_key => $id);
            $result = $this->db->get_where(CompanySizeModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function update($size, $id)
    {
        $this->db->where(CompanySizeModel::$primary_key, $id);
        return $this->db->update(CompanySizeModel::$table_name, $size);
    }

    public function delete($id)
    {
        $this->db->trans_start();

        # delete company related by size
        $this->load->model("CompanyModel");
        $company =  new CompanyModel();
        $company->delete_by_size($id);

        # remove the size itself
        $condition = array(CompanySizeModel::$primary_key => $id);
        $this->db->delete(CompanySizeModel::$table_name, $condition);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}