<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 9:53 PM
 */

class PortfolioModel extends CI_Model
{
    public static $table_name = "jm_portfolio";
    public static $primary_key = "prt_id";

    public static $foreign_employee = "prt_employee";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($portfolio)
    {
        return $this->db->insert(PortfolioModel::$table_name, $portfolio);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(PortfolioModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(PortfolioModel::$primary_key => $id);
            $result = $this->db->get_where(PortfolioModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_employee($employee)
    {
        $condition = array(PortfolioModel::$foreign_employee => $employee);
        $result = $this->db->get_where(PortfolioModel::$table_name, $condition);
        return $result->result_array();
    }

    public function update($education, $id)
    {
        $this->db->where(PortfolioModel::$primary_key, $id);
        return $this->db->update(PortfolioModel::$table_name, $education);
    }

    public function delete($id)
    {
        $portfolio = $this->read($id)["prt_screenshot"];
        $condition = array(PortfolioModel::$primary_key => $id);
        $result = $this->db->delete(PortfolioModel::$table_name, $condition);
        if($result)
        {
            if (file_exists("./assets/img/portfolio/" . $portfolio))
            {
                unlink("./assets/img/portfolio/" . $portfolio);
            }
        }
        return $result;
    }

    public function delete_by_employee($employee)
    {
        $employees = $this->read_by_employee($employee);

        $this->db->trans_start();

        foreach($employees as $row):
            $this->delete([$row["prt_id"]]);
        endforeach;

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}