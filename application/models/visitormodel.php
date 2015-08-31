<?php

/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 18/02/2015
 * Time: 20:57
 */
class VisitorModel extends CI_Model
{
    public static $table_name = "jm_visitor";
    public static $primary_key = "vst_id";

    public static $date = "vst_date";
    public static $visitor = "vst_visitor";
    public static $hit = "vst_hit";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($visitor)
    {
        $result = $this->db->insert(VisitorModel::$table_name, $visitor);
        return $result;
    }

    public function read($date = null)
    {
        if ($date == null) {
            $result = $this->db->get(VisitorModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(VisitorModel::$date => $date);
            $result = $this->db->get_where(VisitorModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_total_visitor()
    {
        $this->db->select_sum(VisitorModel::$visitor);
        $result = $this->db->get(VisitorModel::$table_name);
        return $result->row_array()[VisitorModel::$visitor];
    }

    public function read_total_hit()
    {
        $this->db->select_sum(VisitorModel::$hit);
        $result = $this->db->get(VisitorModel::$table_name);
        return $result->row_array()[VisitorModel::$hit];
    }

    public function read_statistic()
    {
        $statistic = array();
        $result = $this->db->query("
        SELECT
            IFNULL(SUM(" . VisitorModel::$visitor . "),0) AS total,
            IFNULL(ROUND(AVG(" . VisitorModel::$visitor . ")),0) AS average,
            IFNULL(MAX(" . VisitorModel::$visitor . "),0) AS max,
            IFNULL(MIN(" . VisitorModel::$visitor . "),0) AS min

            FROM sl_visitor
            WHERE MONTH(vst_created_at)=MONTH(CURDATE())
        ");
        $statistic["visitor"] = $result->row_array();

        $result = $this->db->query("
        SELECT
            IFNULL(SUM(" . VisitorModel::$hit . "),0) AS total,
            IFNULL(ROUND(AVG(" . VisitorModel::$hit . ")),0) AS average,
            IFNULL(MAX(" . VisitorModel::$hit . "),0) AS max,
            IFNULL(MIN(" . VisitorModel::$hit . "),0) AS min

            FROM sl_visitor
            WHERE MONTH(vst_created_at)=MONTH(CURDATE())
        ");
        $statistic["hit"] = $result->row_array();

        return $statistic;
    }

    public function read_chart_statistic()
    {
        $result = $this->db->query("
          SELECT
            mth_id,
            mth_month,
            IFNULL(SUM(vst_visitor),0) AS vst_visitor,
            IFNULL(SUM(vst_hit),0) AS vst_hit

            FROM jm_month

            LEFT JOIN jm_visitor
              ON mth_id = MONTH(vst_created_at)

            GROUP BY mth_id ORDER BY mth_id
        ");
        $statistic = $result->result_array();

        return $statistic;
    }

    public function check_visitor()
    {
        if (isset($_COOKIE["jm-visitor"])) {
            if ($_COOKIE["jm-visitor"] != $_SERVER["REMOTE_ADDR"]) {
                $this->revisit();
            } else {
                $this->hit();
            }
        } else {
            $this->revisit();
        }
    }

    public function hit()
    {
        $current_date = date("Y-m-d");

        $result = $this->read($current_date);
        if (sizeof($result) > 0) {
            $current_hit = $result[VisitorModel::$hit];
            $this->update(array(VisitorModel::$hit => $current_hit + 1), $current_date);
        } else {
            $this->create(
                array(
                    VisitorModel::$date => $current_date,
                    VisitorModel::$visitor => 1,
                    VisitorModel::$hit => 1
                )
            );
        }
    }

    public function revisit()
    {
        $cookie_visitor = "jm-visitor";
        $cookie_ip = $_SERVER["REMOTE_ADDR"];

        setcookie($cookie_visitor, $cookie_ip, time() + 86400, "/");

        $current_date = date("Y-m-d");

        $result = $this->read($current_date);

        if (sizeof($result) > 0) {
            $current_visitor = $result[VisitorModel::$visitor];
            $this->update(array(VisitorModel::$visitor => $current_visitor + 1), $current_date);
        } else {
            $this->create(
                array(
                    VisitorModel::$date => $current_date,
                    VisitorModel::$visitor => 1,
                    VisitorModel::$hit => 1
                )
            );
        }
    }

    public function update($visitor, $date)
    {
        $this->db->where(VisitorModel::$date, $date);
        $result = $this->db->update(VisitorModel::$table_name, $visitor);
        return $result;
    }

    public function delete($id)
    {
        $result = $this->db->delete(VisitorModel::$table_name, array(VisitorModel::$primary_key => $id));
        return $result;
    }
}