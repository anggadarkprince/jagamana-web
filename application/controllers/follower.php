<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:30 PM
 */

class Follower extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("FollowerModel", "follower_model");
    }

    public function index()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)){
            $this->_following();
        }
        else if(UserModel::is_authorize(UserModel::$TYPE_COMPANY)){
            $this->_follower();
        }
        else{
            redirect(base_url());
        }
    }

    private function _follower()
    {
        $company = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Follower";
        $data["menu"] = "follower";
        $data["content"] = "website/pages/company/followers";
        $data["followers"] = $this->follower_model->read_by_company($company);

        $this->load->view("website/template", $data);
    }

    private function _following()
    {
        $employee = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Following";
        $data["menu"] = "following";
        $data["content"] = "website/pages/employee/following";
        $data["following"] = $this->follower_model->read_by_employee($employee);

        $this->load->view("website/template", $data);
    }

    public function follow()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
        {
            $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

            $company_id = $this->input->post("company_id");

            $data = array(
                "flw_company" => $company_id,
                "flw_employee" => $employee_id
            );

            $result = $this->follower_model->create($data);

            if($result)
            {
                echo "success";
                return;
            }
            echo "failed";
            return;
        }
        else{
            echo "restrict";
            return;
        }
    }

    public function undo()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            $company_id = $this->session->userdata(UserModel::$SESSION_ID);

            $employee_id = $this->input->post("employee_id");

            $data = array(
                "flw_company" => $company_id,
                "flw_employee" => $employee_id
            );

            $result = $this->follower_model->create($data);

            if($result)
            {
                echo "success";
                return;
            }
            echo "failed";
            return;
        }
        else{
            echo "restrict";
            return;
        }
    }

    public function unfollow()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
        {
            $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

            $company_id = $this->input->post("company_id");

            $result = $this->follower_model->delete($company_id, $employee_id);

            if($result)
            {
                echo "success";
                return;
            }
            echo "failed";
            return;
        }
        else{
            echo "restrict";
            return;
        }
    }

    public function delete()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
        {
            $company_id = $this->session->userdata(UserModel::$SESSION_ID);

            $employee_id = $this->input->post("employee_id");

            $result = $this->follower_model->delete($company_id, $employee_id);

            if($result)
            {
                echo "success";
                return;
            }
            echo "failed";
            return;
        }
        else{
            echo "restrict";
            return;
        }
    }

}