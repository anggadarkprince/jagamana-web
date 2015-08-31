<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/9/2015
 * Time: 4:22 PM
 */

class Portfolio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function upload()
    {
        $this->load->model("PortfolioModel", "portfolio_model");
        $this->load->model("UploaderModel", "uploader_model");

        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $config = array(
            "allowed_types" => UploaderModel::$TYPE_IMAGE,
            "upload_path" => "./assets/img/portfolio",
            "file_name" => "portfolio-".$this->session->userdata(UserModel::$SESSION_NAME)."-".rand(10000,99999),
            "overwrite" => FALSE,
            "input_source" => "jm-portfolio-upload",
            "max_width" => 3000,
            "max_height" => 3000
        );
        $this->uploader_model->config($config);

        $upload = $this->uploader_model->start_upload();

        if($upload)
        {
            $data = array(
                "prt_title" => "Portfolio",
                "prt_screenshot" => $this->uploader_model->upload_data()["file_name"],
                "prt_employee" => $employee_id
            );

            $result = $this->portfolio_model->create($data, $employee_id);

            if($result){
                $this->alert->success_alert("Portfolio has been uploaded");
            }
            else {
                $this->alert->danger_alert("Something is getting wrong");
            }
        }
        else
        {
            $this->alert->warning_alert($this->uploader_model->upload_error());
        }

        redirect("resume/standard");
    }

    public function delete($id)
    {
        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->load->model("PortfolioModel", "portfolio_model");

        $result = $this->portfolio_model->delete($id, $employee_id);

        if($result)
        {
            $this->alert->success_alert("Portfolio has been removed successfully");
        }
        else
        {
            $this->alert->danger_alert("Something is getting wrong");
        }

        redirect("resume/standard");
    }
}