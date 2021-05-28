<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 8:50 PM
 */

class CityModel extends CI_Model
{
    public static $table_name = "jm_city";
    public static $primary_key = "cty_id";

    public static $foreign_state = "cty_state";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($city)
    {
        return $this->db->insert(CityModel::$table_name, $city);
    }

    public function read($id = null, $start = null, $limit = null)
    {
        if ($id == null) {
            $query = "SELECT jm_city.*, COUNT(cmp_id) AS company FROM jm_city LEFT JOIN jm_company ON cty_id = cmp_location GROUP BY cty_id ORDER BY company DESC";
            if(($start != null || $start >= 0) && ($limit != null && $limit > 0))
            {
                $query .= " LIMIT $start, $limit";
            }
            $result = $this->db->query($query);
            return $result->result_array();
        } else {
            $condition = array(CityModel::$primary_key => $id);
            $result = $this->db->get_where(CityModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_indonesia_city()
    {
        $query = $this->db->query("SELECT city.*, COUNT(cmp_id) company FROM (SELECT cty_id, cty_city FROM jm_view_location WHERE ctr_country = 'Indonesia') city LEFT JOIN jm_company ON cty_id = cmp_location GROUP BY cty_id, cty_city  ORDER BY company DESC");
        return $query->result_array();
    }

    public function read_by_state($state)
    {
        $condition = array(CityModel::$foreign_state => $state);
        $result = $this->db->get_where(CityModel::$table_name, $condition);
        return $result->result_array();
    }

    public function update($city, $id)
    {
        return $this->db->update(CityModel::$table_name, $city)
            ->where(CityModel::$primary_key, $id);
    }

    public function delete($id)
    {
        $this->db->start_transaction();

        # delete company related by city
        $company =  new CompanyModel();
        $company->delete_by_location($id);

        # remove the city itself
        $condition = array(CityModel::$primary_key => $id);
        $this->db->delete(CityModel::$table_name, $condition);

        $this->db->complete_transaction();

        return $this->db->transaction_status();
    }

    public function delete_by_state($state)
    {
        $cities = $this->read_by_state($state);
        foreach($cities as $city):
            $this->delete($city[CityModel::$primary_key]);
        endforeach;
    }
}