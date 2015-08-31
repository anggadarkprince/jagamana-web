<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 9:17 PM
 */

class CompanyFieldModel extends CI_Model
{
    public static $table_name = "jm_company_field";
    public static $primary_key = "cfd_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($field)
    {
        return $this->db->insert(CompanyFieldModel::$table_name, $field);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->query("SELECT jm_company_field.*, COUNT(cmp_id) AS company FROM jm_company_field LEFT JOIN jm_company ON cfd_id = cmp_field GROUP BY cfd_id ORDER BY company DESC");
            return $result->result_array();
        } else {
            $condition = array(CompanyFieldModel::$primary_key => $id);
            $result = $this->db->get_where(CompanyFieldModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function update($field, $id)
    {
        $this->db->where(CompanyFieldModel::$primary_key, $id);
        return $this->db->update(CompanyFieldModel::$table_name, $field);
    }

    public function delete($id)
    {
        $this->db->trans_start();

        # delete company related by field
        $this->load->model("CompanyModel");
        $company =  new CompanyModel();
        $company->delete_by_field($id);

        # remove the field itself
        $condition = array(CompanyFieldModel::$primary_key => $id);
        $this->db->delete(CompanyFieldModel::$table_name, $condition);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}