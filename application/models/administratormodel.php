<?php

/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 8:15 PM
 */
class AdministratorModel extends CI_Model
{

    public static $table_name = "jm_administrator";
    public static $primary_key = "adm_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function check_auth($username, $password)
    {
        $condition = array(
            "adm_username" => $username,
            "adm_password" => md5($password)
        );
        $result = $this->db->get_where(AdministratorModel::$table_name, $condition);

        if($result){
            if($result->num_rows() != 0)
            {
                $data = $result->row_array();

                $this->session->set_userdata(UserModel::$SESSION_ROLE,UserModel::$TYPE_ADMINISTRATOR);
                $this->session->set_userdata(UserModel::$SESSION_EMAIL,$data["adm_username"]);
                $this->session->set_userdata(UserModel::$SESSION_ID,$data["adm_id"]);
                $this->session->set_userdata(UserModel::$SESSION_NAME,$data["adm_name"]);
                $this->session->set_userdata(UserModel::$SESSION_AVATAR,$data["adm_avatar"]);
                $this->session->set_userdata(UserModel::$SESSION_STATUS,"ACTIVE");

                $this->session->set_userdata("jm_new_employee",true);
                $this->session->set_userdata("jm_new_company",true);
                $this->session->set_userdata("jm_new_job",true);
                $this->session->set_userdata("jm_new_application",true);

                return "granted";
            }
            else
            {
                return "mismatch";
            }
        }
        else
        {
            return "error";
        }
    }

    public function destroy_auth()
    {
        $this->session->unset_userdata(UserModel::$SESSION_ROLE);
        $this->session->unset_userdata(UserModel::$SESSION_EMAIL);
        $this->session->unset_userdata(UserModel::$SESSION_ID);
        $this->session->unset_userdata(UserModel::$SESSION_AVATAR);
        $this->session->unset_userdata(UserModel::$SESSION_NAME);
        $this->session->unset_userdata(UserModel::$SESSION_STATUS);
    }

    public function create($administrator)
    {
        return $this->db->insert(AdministratorModel::$table_name, $administrator);
    }

    public function read($id = null)
    {
        if ($id == null) {
            $result = $this->db->get(AdministratorModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(AdministratorModel::$primary_key => $id);
            $result = $this->db->get_where(AdministratorModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function update($administrator, $id)
    {
        $this->db->where(AdministratorModel::$primary_key, $id);
        return $this->db->update(AdministratorModel::$table_name, $administrator);
    }

    public function delete($id)
    {
        $condition = array(AdministratorModel::$primary_key => $id);
        return $this->db->delete(AdministratorModel::$table_name, $condition);
    }

}