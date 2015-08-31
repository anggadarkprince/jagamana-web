<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 11:33 PM
 */

class Bookmark extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)) {
            redirect(base_url());
        }
        $this->load->model("BookmarkModel", "bookmark_model");
    }

    public function index()
    {
        $employee = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Bookmark";
        $data["menu"] = "bookmark";
        $data["content"] = "website/pages/employee/bookmark";
        $data["bookmarks"] = $this->bookmark_model->read_by_employee($employee);

        $this->load->view("website/template", $data);
    }

    public function save()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
            {
                $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

                $job_id = $this->input->post("job_id");

                $data = array(
                    "bmk_employee" => $employee_id,
                    "bmk_job" => $job_id
                );

                $result = $this->bookmark_model->create($data);

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
        else
        {
            redirect("error404");
        }
    }

    public function delete()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
            {
                $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

                $job_id = $this->input->post("job_id");

                $result = $this->bookmark_model->delete($job_id, $employee_id);

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
        else
        {
            redirect("error404");
        }

    }

}