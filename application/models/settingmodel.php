<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:18 PM
 */

class SettingModel extends CI_Model
{
    public static $table_name = "jm_setting";
    public static $primary_key = "stg_id";

    public static $table_key = "stg_key";
    public static $table_value = "stg_value";

    public function __construct()
    {
        parent::__construct();
    }

    public function create($setting)
    {
        return $this->db->insert(SettingModel::$table_name, $setting);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(SettingModel::$table_name);
            $data = $result->result_array();
            $settings = array();
            foreach ($data as $setting) {
                $settings[$setting["stg_key"]] = $setting["stg_value"];
            }
            return $settings;
        } else {
            $result = $this->db->get_where(SettingModel::$table_name, array(SettingModel::$primary_key => $id));
            return $result->row_array();
        }
    }

    public function read_employee_setting($employee)
    {
        $this->load->model("EmployeeModel");
        $employee_model = new EmployeeModel();
        return $employee_model->read($employee);
    }

    public function read_company_setting($company)
    {
        $this->load->model("CompanyModel");
        $company_model = new CompanyModel();
        return $company_model->read_by_id($company);
    }

    public function update_employee_setting($data)
    {
        if($_FILES["jm-setting-avatar"]["size"] != 0 && $_FILES["jm-setting-avatar"]["name"] != "")
        {
            $config = array(
                'allowed_types' => 'jpg|jpeg|gif|png',
                'upload_path' => "./assets/img/avatar",
                'max_size' => 2000,
                'max_width' => '2000',
                'max_height' => '2000',
                'file_name' => $this->session->userdata(UserModel::$SESSION_ID),
                'overwrite' => true
            );

            $status = array();

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('jm-setting-avatar')) {
                $status["upload"] = false;
                $status["message"] = $this->upload->display_errors();
                return $status;
            } else {
                $status["upload"] = true;
                $data["emp_avatar"] = $this->upload->data()["file_name"];
                $this->session->set_userdata(UserModel::$SESSION_AVATAR, $data["emp_avatar"]);
            }
        }

        if($data["emp_password"] == "" || $data["emp_password"] == null)
        {
            unset($data["emp_password"]);
        }
        else{
            $data["emp_password"] = md5($data["emp_password"]);
        }

        $this->load->model("EmployeeActivityModel", "employee_activity_model");
        $this->employee_activity_model->activity_setting();

        $this->load->model("EmployeeModel");
        $employee_model = new EmployeeModel();
        $status["query"] = $employee_model->update($data, $this->session->userdata(UserModel::$SESSION_ID));

        if($status["query"])
        {
            $this->session->set_userdata(UserModel::$SESSION_NAME, $data["emp_name"]);
            $this->session->set_userdata(UserModel::$SESSION_STATUS, $data["emp_status"]);
        }

        return $status;
    }

    public function update_company_setting($data)
    {
        if($data["cmp_password"] == "" || $data["cmp_password"] == null)
        {
            unset($data["cmp_password"]);
        }
        else{
            $data["cmp_password"] = md5($data["cmp_password"]);
        }

        $this->load->model("CompanyActivityModel", "company_activity_model");
        $this->company_activity_model->activity_setting();

        $this->load->model("CompanyModel");
        $company_model = new CompanyModel();
        $status = $company_model->update($data, $this->session->userdata(UserModel::$SESSION_ID));

        if($status)
        {
            $this->session->set_userdata(UserModel::$SESSION_STATUS, $data["emp_status"]);
        }

        return $status;
    }

    public function update($data, $administrator)
    {
        $status = array();

        if ($data["Favicon"] == null) {
            unset($data["Favicon"]);
        } else {
            $config = array(
                'allowed_types' => 'jpg|jpeg|gif|png',
                'upload_path' => "./assets/img/layout",
                'max_size' => 512,
                'max_width' => '256',
                'max_height' => '256',
                'file_name' => "favicon",
                'overwrite' => true
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('jm-setting-favicon'))
            {
                $status["upload"] = false;
                $status["message"] = $this->upload->display_errors();
                return $status;
            }
            else
            {
                $data["Favicon"] = $this->upload->data()["file_name"];
                $status["upload"] = true;
            }
        }

        if($administrator["adm_avatar"] == null){
            unset($administrator["adm_avatar"]);
        }
        else{
            $this->load->model("UploaderModel", "uploader_model");
            $config = array(
                "allowed_types" => UploaderModel::$TYPE_IMAGE,
                "upload_path" => "./assets/img/avatar",
                "file_name" => $this->session->userdata(UserModel::$SESSION_ID),
                "overwrite" => TRUE,
                "input_source" => "jm-setting-avatar",
                "max_width" => 2000,
                "max_height" => 2000
            );
            $this->uploader_model->config($config);

            $upload = $this->uploader_model->start_upload();

            if(!$upload){
                $status["upload"] = false;
                $status["message"] = $this->uploader_model->upload_error();
                return $status;
            }
            else
            {
                $administrator["adm_avatar"] = $this->uploader_model->upload_data()["file_name"];
                $this->session->set_userdata(UserModel::$SESSION_AVATAR, $administrator["adm_avatar"]);
                $status["upload"] = true;
            }
        }

        $this->load->model("AdministratorModel", "administrator_model");
        $administrator_id = $this->session->userdata(UserModel::$SESSION_ID);

        $this->db->trans_start();

        $this->administrator_model->update($administrator, $administrator_id);

        foreach ($data as $setting => $value) {
            $this->db->where(SettingModel::$table_key, $setting);
            $this->db->update(SettingModel::$table_name, array(
                SettingModel::$table_value => $value,
                "stg_admin" => $this->session->userdata(UserModel::$SESSION_ID))
            );
        }

        $this->db->trans_complete();

        $status["query"] = $this->db->trans_status();

        if($status["query"])
        {
            $this->session->set_userdata(UserModel::$SESSION_NAME, $administrator["adm_name"]);
        }

        return $status;
    }

    public function delete($id)
    {
        $condition = array(SettingModel::$primary_key => $id);
        return $this->db->delete(SettingModel::$table_name, $condition);
    }
}