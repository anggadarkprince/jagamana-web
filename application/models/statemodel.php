<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 8:50 PM
 */

class StateModel extends CI_Model
{
    public static $table_name = "jm_state";
    public static $primary_key = "stt_id";

    public static $foreign_country = "stt_country";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($state)
    {
        return $this->db->insert(StateModel::$table_name, $state);
    }

    public function read($id = null, $start = null, $limit = null)
    {
        if ($id == null) {
            $query = "SELECT * FROM jm_state";
            if(($start != null || $start >= 0) && ($limit != null && $limit > 0))
            {
                $query .= " LIMIT $start, $limit";
            }
            $result = $this->db->query($query);
            return $result->result_array();
        } else {
            $condition = array(StateModel::$primary_key => $id);
            $result = $this->db->get_where(StateModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_country($country)
    {
        $condition = array(StateModel::$foreign_country => $country);
        $result = $this->db->get_where(StateModel::$table_name, $condition);
        return $result->result_array();
    }

    public function update($state, $id)
    {
        return $this->db->update(StateModel::$table_name, $state)
            ->where(StateModel::$primary_key, $id);
    }

    public function delete($id)
    {
        $this->db->start_transaction();

        # delete city related by state
        $city =  new CityModel();
        $city->delete_by_state($id);

        # remove the state itself
        $condition = array(StateModel::$primary_key => $id);
        $this->db->delete(StateModel::$table_name, $condition);

        $this->db->complete_transaction();

        return $this->db->transaction_status();
    }

    public function delete_by_country($country)
    {
        $states = $this->read_by_country($country);
        foreach($states as $state):
            $this->delete($state[StateModel::$primary_key]);
        endforeach;
    }
}