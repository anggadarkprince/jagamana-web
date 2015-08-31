<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 9:01 PM
 */

class CountryModel extends CI_Model
{
    public static $table_name = "jm_country";
    public static $primary_key = "ctr_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($country)
    {
        return $this->db->insert(CountryModel::$table_name, $country);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(CountryModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(CountryModel::$primary_key => $id);
            $result = $this->db->get_where(CountryModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function update($country, $id)
    {
        return $this->db->update(CountryModel::$table_name, $country)
            ->where(CountryModel::$primary_key, $id);
    }

    public function delete($id)
    {
        $this->db->start_transaction();

        # remove state related by country
        $city = new StateModel();
        $city->delete_by_country($id);

        # remove the country itself
        $condition = array(CountryModel::$primary_key => $id);
        $this->db->delete(CountryModel::$table_name, $condition);

        $this->db->complete_transaction();

        return $this->db->transaction_status();
    }
}