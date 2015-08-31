<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:03 PM
 */

class EmployeeModel extends CI_Model
{
    public static $table_name = "jm_employee";
    public static $primary_key = "emp_id";

    public static $field_token = "emp_token";

    private $active = "ACTIVE";
    private $suspend = "SUSPEND";

    private $employee_total = 0;

    public function __construct()
    {
        parent::__construct();
    }

    public function get_employee_total()
    {
        return $this->employee_total;
    }

    public function activating($id)
    {
        $accept = array("emp_status" => $this->active);
        $this->db->where(EmployeeModel::$primary_key, $id);
        return $this->db->update(EmployeeModel::$table_name, $accept);
    }

    public function suspending($id)
    {
        $accept = array("emp_status" => $this->suspend);
        $this->db->where(EmployeeModel::$primary_key, $id);
        return $this->db->update(EmployeeModel::$table_name, $accept);
    }

    public function create($employee)
    {
        return $this->db->insert(EmployeeModel::$table_name, $employee);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(EmployeeModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(EmployeeModel::$primary_key => $id);
            $result = $this->db->get_where(EmployeeModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_suspended()
    {
        $this->db->where("emp_status", $this->suspend);
        $this->db->order_by("emp_updated_at", "desc");
        $result = $this->db->get(EmployeeModel::$table_name);
        return $result->result_array();
    }

    public function read_all()
    {
        $result = $this->db->query("SELECT * FROM jm_employee WHERE emp_status != 'SUSPEND' ORDER BY emp_created_at DESC");
        return $result->result_array();
    }

    public function read_by_token($token)
    {
        $condition = array(EmployeeModel::$field_token => $token);
        $result = $this->db->get_where(EmployeeModel::$table_name, $condition);
        return $result->row_array();
    }

    public function get_new_employee()
    {
        $query = "SELECT COUNT(emp_id) AS total FROM jm_employee WHERE DATE(emp_created_at) BETWEEN CURDATE() - INTERVAL 3 DAY AND CURDATE()";
        $result = $this->db->query($query)->row_array();
        return $result["total"];
    }

    public function search($query, $start = null, $limit = null)
    {
        $query = "SELECT * FROM jm_employee WHERE jm_employee.emp_name LIKE '%$query%' ORDER BY emp_created_at DESC";
        $result = $this->db->query($query);

        $this->employee_total = $result->num_rows();

        if(($start != null || $start >= 0) && ($limit != null && $limit > 0))
        {
            if($start == ""){
                $start = 0;
            }
            $query .= " LIMIT $start,$limit";
        }

        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function update($employee, $id)
    {
        $this->db->where(EmployeeModel::$primary_key, $id);
        return $this->db->update(EmployeeModel::$table_name, $employee);
    }

    public function delete($id)
    {
        $this->db->trans_start();

        # remove bookmark related employee
        $this->load->model("BookmarkModel");
        $bookmark = new BookmarkModel();
        $bookmark->delete_by_employee($id);

        # remove follower related employee
        $this->load->model("FollowerModel");
        $follower = new FollowerModel();
        $follower->delete_by_employee($id);

        # remove activity related employee
        $this->load->model("EmployeeActivityModel");
        $activity = new EmployeeActivityModel();
        $activity->delete_by_employee($id);

        # remove cv list of experience related employee
        $this->load->model("ExperienceModel");
        $experience = new ExperienceModel();
        $experience->delete_by_employee($id);

        # remove cv list of education related employee
        $this->load->model("PortfolioModel");
        $education = new PortfolioModel();
        $education->delete_by_employee($id);

        # remove thread list related employee
        $this->load->model("ThreadModel");
        $thread = new ThreadModel();
        $thread->delete_by_employee($id);

        # remove application ever sent
        $this->load->model("ApplicationModel");
        $application = new ApplicationModel();
        $application->delete_by_employee($id);

        # remove employee itself
        $condition = array(EmployeeModel::$primary_key => $id);
        $this->db->delete(EmployeeModel::$table_name, $condition);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}