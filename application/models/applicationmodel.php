<?php

/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 8:20 PM
 */
class ApplicationModel extends CI_Model
{
    public static $table_name = "jm_application";
    public static $view_name = "jm_view_application";
    public static $primary_key = "apl_id";
    public static $view_key = "application_id";

    public static $foreign_job = "apl_job";
    public static $foreign_employee = "apl_employee";

    private $pending = "PENDING";
    private $accept = "ACCEPT";
    private $reject = "REJECT";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($application)
    {
        $this->load->model("JobModel","job_model");
        $job = $this->job_model->read_by_id($application["apl_job"]);

        $this->load->model("EmployeeActivityModel", "employee_activity_model");
        $this->employee_activity_model->activity_apply($job["vacancy"], $job["job_id"]);

        $this->load->model("EmployeeModel","employee_model");
        $employee = $this->employee_model->read($application["apl_employee"]);

        $this->load->model("CompanyActivityModel", "company_activity_model");
        $this->company_activity_model->notification_applied($job["job_company"], $employee["emp_name"], $employee["emp_id"], $job["vacancy"], $job["job_id"]);

        return $this->db->insert(ApplicationModel::$table_name, $application);
    }

    public function accept_application($id)
    {
        $application = $this->read_by_id($id);

        $this->load->model("JobModel","job_model");
        $job = $this->job_model->read_by_id($application["apl_job"]);

        $this->load->model("EmployeeActivityModel", "employee_activity_model");
        $this->employee_activity_model->notification_confirmed($application["apl_employee"], $job["job_vacancy"], $job["job_id"]);

        $accept = array("apl_status" => $this->accept);
        $this->db->where(ApplicationModel::$primary_key, $id);
        return $this->db->update(ApplicationModel::$table_name, $accept);
    }

    public function reject_application($id)
    {
        $application = $this->read_by_id($id);

        $this->load->model("JobModel","job_model");
        $job = $this->job_model->read_by_id($application["apl_job"]);

        $this->load->model("EmployeeActivityModel", "employee_activity_model");
        $this->employee_activity_model->notification_rejected($application["apl_employee"], $job["job_vacancy"], $job["job_id"]);

        $reject = array("apl_status" => $this->reject);
        $this->db->where(ApplicationModel::$primary_key, $id);
        return $this->db->update(ApplicationModel::$table_name, $reject);
    }

    public function discard_application($id)
    {
        $accept = array("apl_status" => $this->pending);
        $this->db->where(ApplicationModel::$primary_key, $id);
        return $this->db->update(ApplicationModel::$table_name, $accept);
    }

    public function read($status = null)
    {
        if ($status == null) {
            $this->db->order_by("created_at", "desc");
            $result = $this->db->get(ApplicationModel::$view_name);
            return $result->result_array();
        } else {
            $query = "
              SELECT
                jm_view_application.*,
                emp_email AS employee_email,
                emp_resume AS employee_resume,
                emp_avatar AS employee_avatar
                FROM jm_view_application
                INNER JOIN jm_employee
                  ON employee_id = emp_id
                WHERE status = '$status'";
            $result = $this->db->query($query);
            return $result->result_array();
        }
    }

    public function read_by_id($id)
    {
        $condition = array(ApplicationModel::$primary_key => $id);
        $result = $this->db->get_where(ApplicationModel::$table_name, $condition);
        return $result->row_array();
    }

    public function read_by_company($company)
    {
        $query = "
          SELECT
            jm_view_application.*,
            emp_email AS employee_email,
            emp_resume AS employee_resume,
            emp_avatar AS employee_avatar
            FROM jm_view_application
            INNER JOIN jm_employee
              ON employee_id = emp_id
            WHERE company_id = '$company'";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function read_by_employee($employee)
    {
        $condition = array("employee_id" => $employee);
        $result = $this->db->get_where(ApplicationModel::$view_name, $condition);
        return $result->result_array();
    }

    public function read_by_job($job)
    {
        $query = "
          SELECT
            jm_view_application.*,
            emp_email AS employee_email,
            emp_resume AS employee_resume,
            emp_avatar AS employee_avatar
            FROM jm_view_application
            INNER JOIN jm_employee
              ON employee_id = emp_id
            WHERE job_id = '$job'";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function get_statistic_applied($employee)
    {
        $this->db->where(ApplicationModel::$foreign_employee, $employee);
        $this->db->from(ApplicationModel::$table_name);
        return $this->db->count_all_results();
    }

    public function get_statistic_applicant($company)
    {
        $this->db->where("company_id", $company);
        $this->db->from(ApplicationModel::$view_name);
        return $this->db->count_all_results();
    }

    public function get_statistic_range_applicant($company)
    {
        $query = "
            SELECT mth_id, mth_month, IFNULL(accept,0) AS accept, IFNULL(pending,0) AS pending, IFNULL(reject,0) AS reject
            FROM jm_month

            LEFT JOIN
              (SELECT MONTH(created_at) AS month, COUNT(application_id) AS accept
              FROM jm_view_application
              WHERE company_id = '$company' AND status='ACCEPT' AND YEAR(created_at) = YEAR(CURDATE())
              GROUP BY MONTH(created_at)
              ) AS accept
            ON mth_id = accept.month

            LEFT JOIN
              (SELECT MONTH(created_at) AS month, COUNT(application_id) AS pending
              FROM jm_view_application
              WHERE company_id = '$company' AND status='PENDNG' AND YEAR(created_at) = YEAR(CURDATE())
              GROUP BY MONTH(created_at)
              ) AS pending
            ON mth_id = pending.month

            LEFT JOIN
              (SELECT MONTH(created_at) AS month, COUNT(application_id) AS reject
              FROM jm_view_application
              WHERE company_id = '$company' AND status='REJECT' AND YEAR(created_at) = YEAR(CURDATE())
              GROUP BY MONTH(created_at)
              ) AS reject
            ON mth_id = reject.month

            ORDER BY mth_id
        ";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function get_statistic_range_applied($employee)
    {
        $query = "
            SELECT mth_id, mth_month, IFNULL(accept,0) AS accept, IFNULL(pending,0) AS pending, IFNULL(reject,0) AS reject
            FROM jm_month

            LEFT JOIN
              (SELECT MONTH(apl_created_at) as month, YEAR(apl_created_at) as year, COUNT(apl_status) AS accept
                FROM jm_application
                WHERE apl_employee = '$employee' AND apl_status = 'ACCEPT' AND YEAR(apl_created_at) = YEAR(CURDATE())
                GROUP BY MONTH(apl_created_at),YEAR(apl_created_at),apl_status
                ) AS accept
            ON mth_id = accept.month

            LEFT JOIN
              (SELECT MONTH(apl_created_at) as month, YEAR(apl_created_at) as year, COUNT(apl_status) AS pending
                FROM jm_application
                WHERE apl_employee = '$employee' AND apl_status = 'PENDING' AND YEAR(apl_created_at) = YEAR(CURDATE())
                GROUP BY MONTH(apl_created_at),YEAR(apl_created_at),apl_status
                ) AS pending
            ON mth_id = pending.month

            LEFT JOIN
              (SELECT MONTH(apl_created_at) as month, YEAR(apl_created_at) as year, COUNT(apl_status) AS reject
                FROM jm_application
                WHERE apl_employee = '$employee' AND apl_status = 'REJECT' AND YEAR(apl_created_at) = YEAR(CURDATE())
                GROUP BY MONTH(apl_created_at),YEAR(apl_created_at),apl_status
                ) AS reject
            ON mth_id = reject.month

            ORDER BY mth_id
        ";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function get_daily_statistic()
    {
        $query = "
          SELECT created_at, COUNT(application_id) AS application
            FROM jm_view_application
            GROUP BY DATE(created_at), MONTH(created_at), YEAR(created_at)
            ORDER BY created_at DESC LIMIT 1000
            ";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function get_new_application()
    {
        $query = "SELECT COUNT(apl_id) AS total FROM jm_application WHERE DATE(apl_created_at) BETWEEN CURDATE() - INTERVAL 3 DAY AND CURDATE()";
        $result = $this->db->query($query)->row_array();
        return $result["total"];
    }

    public function update($application, $id)
    {
        $this->db->where(ApplicationModel::$primary_key, $id);
        return $this->db->update(ApplicationModel::$table_name, $application);
    }

    public function delete($id)
    {
        $condition = array(ApplicationModel::$primary_key => $id);
        return $this->db->delete(ApplicationModel::$table_name, $condition);
    }

    public function delete_by_job($job)
    {
        $condition = array(ApplicationModel::$foreign_job => $job);
        return $this->db->delete(ApplicationModel::$table_name, $condition);
        /*
        $applications = $this->read_by_job($job);

        $this->db->trans_start();

        foreach($applications as $application):
            $this->update(array("apl_job" => null), $application[ApplicationModel::$primary_key]);
        endforeach;

        $this->db->trans_complete();

        return $this->db->trans_status();
        */
    }

    public function delete_by_employee($employee)
    {
        $condition = array(ApplicationModel::$foreign_employee => $employee);
        return $this->db->delete(ApplicationModel::$table_name, $condition);
    }
}