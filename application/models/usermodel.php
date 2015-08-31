<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 3:45 PM
 */

class UserModel extends CI_Model
{
    public static $TYPE_COMPANY = "company";
    public static $TYPE_EMPLOYEE = "employee";
    public static $TYPE_ADMINISTRATOR = "administrator";

    public static $SESSION_ID = "jm-id";
    public static $SESSION_NAME = "jm-name";
    public static $SESSION_AVATAR = "jm-avatar";
    public static $SESSION_EMAIL = "jm-email";
    public static $SESSION_ROLE = "jm-role";
    public static $SESSION_STATUS = "jm-status";
    public static $SESSION_PROVIDER = "jm-provider";

    public function __construct()
    {
        parent::__construct();
    }

    public static function is_authorize($type)
    {
        $CI = get_instance();
        if($CI->session->userdata(UserModel::$SESSION_ROLE) == $type){
            return true;
        }
        return false;
    }

    public function check_password($password)
    {
        $email = $this->session->userdata(UserModel::$SESSION_EMAIL);
        if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_COMPANY){
            $company = $this->db->get_where("jm_company",array("cmp_email" => $email, "cmp_password" => md5($password)));
            return ($company->num_rows() > 0);
        }
        else if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_EMPLOYEE){
            $employee = $this->db->get_where("jm_employee",array("emp_email" => $email, "emp_password"=> md5($password)));
            return ($employee->num_rows() > 0);
        }
        else if($this->session->userdata(UserModel::$SESSION_ROLE) == UserModel::$TYPE_ADMINISTRATOR){
            $employee = $this->db->get_where("jm_administrator",array("adm_username" => $email, "adm_password"=> md5($password)));
            return ($employee->num_rows() > 0);
        }
        else{
            return false;
        }
    }

    public function check_email($email, $retrieve_data = false)
    {
        $company = $this->db->get_where("jm_company",array("cmp_email" => $email));
        $employee = $this->db->get_where("jm_employee",array("emp_email" => $email));

        $isCompany = ($company->num_rows() == 0);
        $isEmployee = ($employee->num_rows() == 0);

        if($retrieve_data)
        {
            $data = array();
            if(!$isCompany)
            {
                $row = $company->row_array();
                $data["email"]      = $row["cmp_email"];
                $data["role"]       = UserModel::$TYPE_COMPANY;
                $data["name"]       = $row["cmp_name"];
                $data["token"]      = $row["cmp_token"];
                $data["registered"] = true;
            }
            else if(!$isEmployee)
            {
                $row = $employee->row_array();
                $data["email"]      = $row["emp_email"];
                $data["role"]       = UserModel::$TYPE_EMPLOYEE;
                $data["name"]       = $row["emp_name"];
                $data["token"]      = $row["emp_token"];
                $data["registered"] = true;
            }
            else
            {
                $data["registered"] = false;
            }
            return $data;
        }
        else
        {
            if($isCompany && $isEmployee)
            {
                return true;
            }
            return false;
        }
    }

    public function data_user($role, $token)
    {
        $data = null;
        if($role == "company"){
            $company = $this->db->get_where("jm_company",array("cmp_token" => $token));
            if($company->num_rows() > 0)
            {
                $result = $company->row_array();
                $data = array(
                    "id"    => $result["cmp_id"],
                    "email" => $result["cmp_email"],
                    "name"  => $result["cmp_name"],
                    "token" => $result["cmp_token"],
                    "role"  => UserModel::$TYPE_COMPANY
                );
            }
        }
        else if($role == "employee")
        {
            $employee = $this->db->get_where("jm_employee",array("emp_token" => $token));
            if($employee->num_rows() > 0)
            {
                $result = $employee->row_array();
                $data = array(
                    "id"    => $result["emp_id"],
                    "email" => $result["emp_email"],
                    "name"  => $result["emp_name"],
                    "token" => $result["emp_token"],
                    "role"  => UserModel::$TYPE_EMPLOYEE
                );
            }
        }
        return $data;
    }

    public function check_active_id($id)
    {
        $company = $this->db->get_where("jm_company",array("cmp_id" => $id, "cmp_status" => "ACTIVE"));
        $employee = $this->db->get_where("jm_employee",array("emp_id" => $id, "emp_status" => "ACTIVE"));

        if($employee->num_rows() == 0 && $company->num_rows() == 0){
            return false;
        }
        return true;
    }

    public function register_via_facebook($user)
    {
        $this->load->model("EmployeeModel");

        $this->db->where("emp_oauth_provider", "FACEBOOK");
        $this->db->where("emp_oauth_uid", $user["id"]);
        $result = $this->db->get(EmployeeModel::$table_name);

        if($result->num_rows() == 0)
        {
            $id = md5(time().uniqid());
            $token = md5(time().$user["id"]);

            $this->load->helper("file");

            $avatar_url = "https://graph.facebook.com/{$user['id']}/picture?type=large";
            $avatar = file_get_contents($avatar_url);
            write_file("./assets/img/avatar/".$id.".jpg", $avatar);

            $data = array(
                "emp_id" => $id,
                "emp_name" => $user["name"],
                "emp_password" => md5(""),
                "emp_email" => $user["email"],
                "emp_avatar" => $id.".jpg",
                "emp_oauth_provider" => "FACEBOOK",
                "emp_oauth_uid" => $user["id"],
                "emp_status" => "ACTIVE",
                "emp_token" => $token,
                "emp_gender" => strtoupper($user["gender"]),
                "emp_about" => $user["bio"],
                "emp_birthday" => $user["birthday"]->format('Y-m-d')
            );

            $this->db->insert(EmployeeModel::$table_name, $data);

            # create activity
            $this->load->model("EmployeeActivityModel", "employee_activity_model");
            $this->employee_activity_model->activity_register($id, $data["emp_email"]);
        }

        $result = $result->row_array();

        $this->session->set_userdata(UserModel::$SESSION_ROLE,UserModel::$TYPE_EMPLOYEE);
        $this->session->set_userdata(UserModel::$SESSION_EMAIL,$result["emp_email"]);
        $this->session->set_userdata(UserModel::$SESSION_ID,$result["emp_id"]);
        $this->session->set_userdata(UserModel::$SESSION_NAME,$result["emp_name"]);
        $this->session->set_userdata(UserModel::$SESSION_AVATAR,$result["emp_avatar"]);
        $this->session->set_userdata(UserModel::$SESSION_STATUS,$result["emp_status"]);
        $this->session->set_userdata(UserModel::$SESSION_PROVIDER,$result["emp_oauth_provider"]);

        $this->load->model("EmployeeActivityModel", "employee_activity_model");
        $this->employee_activity_model->activity_login($result["emp_id"]);

    }

    public function register_via_twitter($user, $user_token)
    {
        $this->load->model("EmployeeModel");

        $this->db->where("emp_oauth_provider", "TWITTER");
        $this->db->where("emp_oauth_uid", $user->id);
        $result = $this->db->get(EmployeeModel::$table_name);

        if($result->num_rows() == 0)
        {
            $id = md5(time().uniqid());
            $token = md5(time().$user->id);

            $avatar_url = "{$user->profile_image_url_https}";
            $avatar_url = trim(str_replace("_normal", "", $avatar_url));
            $avatar = file_get_contents($avatar_url);
            $this->load->helper("file");
            write_file("./assets/img/avatar/".$id.".jpeg", $avatar);
            //file_put_contents("../../assets/img/avatar/".$id.".jpeg", $avatar);

            $data = array(
                "emp_id" => $id,
                "emp_name" => $user->name,
                "emp_password" => md5(""),
                "emp_email" => $user->screen_name."@twitter.com",
                "emp_avatar" => $id.".jpeg",
                "emp_oauth_provider" => "TWITTER",
                "emp_oauth_uid" => $user->id,
                "emp_oauth_token" => $user_token["oauth_token"],
                "emp_oauth_secret" => $user_token["oauth_token_secret"],
                "emp_status" => "ACTIVE",
                "emp_token" => $token
            );

            $this->db->insert(EmployeeModel::$table_name, $data);

            # create activity
            $this->load->model("EmployeeActivityModel", "employee_activity_model");

            $this->employee_activity_model->activity_register($id, $data["emp_email"]);
        }
        else
        {
            $data = array(
                "emp_oauth_token" => $user_token["oauth_token"],
                "emp_oauth_secret" => $user_token["oauth_token_secret"],
            );
            $this->db->where("emp_oauth_provider", "TWITTER");
            $this->db->where("emp_oauth_uid", $user->id);
            $this->db->update(EmployeeModel::$table_name, $data);
        }

        $query = $this->db->get_where(EmployeeModel::$table_name, array("emp_oauth_provider" => "TWITTER", "emp_oauth_uid" => $user->id));
        $result = $query->row_array();

        $this->session->set_userdata(UserModel::$SESSION_ROLE,UserModel::$TYPE_EMPLOYEE);
        $this->session->set_userdata(UserModel::$SESSION_EMAIL,$result["emp_email"]);
        $this->session->set_userdata(UserModel::$SESSION_ID,$result["emp_id"]);
        $this->session->set_userdata(UserModel::$SESSION_NAME,$result["emp_name"]);
        $this->session->set_userdata(UserModel::$SESSION_AVATAR,$result["emp_avatar"]);
        $this->session->set_userdata(UserModel::$SESSION_STATUS,$result["emp_status"]);
        $this->session->set_userdata(UserModel::$SESSION_PROVIDER,$result["emp_oauth_provider"]);

        $this->load->model("EmployeeActivityModel", "employee_activity_model");
        $this->employee_activity_model->activity_login($result["emp_id"]);
    }

    public function register($data)
    {
        $id = md5(time().uniqid());
        $token = md5(time().$data["email"]);

        if($data['role'] == "jm-role-employee")
        {
            $this->db->trans_start();

            # create employee
            $this->load->model("EmployeeModel", "employee_model");

            $employee = array(
                "emp_id"        => $id,
                "emp_name"      => $data["name"],
                "emp_email"     => $data["email"],
                "emp_password"  => md5($data["password"]),
                "emp_token"     => $token
            );
            $this->employee_model->create($employee);

            # create activity
            $this->load->model("EmployeeActivityModel", "employee_activity_model");

            $this->employee_activity_model->activity_register($id, $data["email"]);

            $this->db->trans_complete();

            $result = array(
                "register"      => $this->db->trans_status(),
                "name"          => $data["name"],
                "role"          => "employee",
                "token"         => $token
            );

            return $result;
        }
        else if($data['role'] == "jm-role-company")
        {
            $this->db->trans_start();

            # create company
            $this->load->model("CompanyModel", "company_model");
            $company = array(
                "cmp_id"        => $id,
                "cmp_name"      => $data["name"],
                "cmp_email"     => $data["email"],
                "cmp_password"  => md5($data["password"]),
                "cmp_token"     => $token
            );
            $this->company_model->create($company);

            # create activity
            $this->load->model("CompanyActivityModel", "company_activity_model");

            $this->company_activity_model->activity_register($id, $data["email"]);

            #create section
            $this->load->model("CompanySectionModel", "company_section_model");

            $this->company_section_model->create_default($id);

            #create photo
            $this->load->model("CompanyPhotoModel", "company_photo_model");

            $this->company_photo_model->create_default($id);

            $this->db->trans_complete();

            $result = array(
                "register"      => $this->db->trans_status(),
                "name"          => $data["name"],
                "role"          => "company",
                "token"         => $token
            );

            return $result;
        }
        else
        {
            $result = array(
                "register"      => false,
                "name"          => null,
                "role"          => null,
                "token"         => null
            );
            return $result;
        }
    }

    public function activate($role, $token)
    {
        if($role == "employee")
        {
            $data = $this->data_user($role, $token);
            $this->load->model("EmployeeActivityModel", "employee_activity_model");
            $this->employee_activity_model->activity_activate($data["id"]);

            $this->load->model("EmployeeModel", "employee_model");
            return $this->db->update(EmployeeModel::$table_name, array("emp_status" => "ACTIVE"))->where("emp_token", $token);
        }
        else if($role == "company")
        {
            $data = $this->data_user($role, $token);
            $this->load->model("CompanyActivityModel", "company_activity_model");
            $this->company_activity_model->activity_activate($data["id"]);

            $this->load->model("CompanyModel", "company_model");
            return $this->db->update(CompanyModel::$table_name, array("cmp_status" => "ACTIVE"),"cmp_token = '$token'");
        }
        else{
            return false;
        }
    }

    public function authentication($email, $password)
    {
        $company = $this->db->get_where("jm_company",array("cmp_email" => $email, "cmp_password" => md5($password)));
        $employee = $this->db->get_where("jm_employee",array("emp_email" => $email, "emp_password" => md5($password)));

        if($company->num_rows() > 0)
        {
            $result = $company->row_array();

            $this->session->set_userdata(UserModel::$SESSION_ROLE,UserModel::$TYPE_COMPANY);
            $this->session->set_userdata(UserModel::$SESSION_EMAIL,$result["cmp_email"]);
            $this->session->set_userdata(UserModel::$SESSION_ID,$result["cmp_id"]);
            $this->session->set_userdata(UserModel::$SESSION_NAME,$result["cmp_name"]);
            $this->session->set_userdata(UserModel::$SESSION_AVATAR,$result["cmp_logo"]);
            $this->session->set_userdata(UserModel::$SESSION_STATUS,$result["cmp_status"]);
            $this->session->set_userdata(UserModel::$SESSION_PROVIDER,$result["cmp_oauth_provider"]);

            $this->load->model("CompanyActivityModel", "company_activity_model");
            $this->company_activity_model->activity_login($result["cmp_id"]);

            return array(
                "login"     => true,
                "status"    => $result["cmp_status"],
                "name"      => $result["cmp_name"],
                "token"     => $result["cmp_token"],
                "role"      => "company"
            );
        }
        if($employee->num_rows() > 0)
        {
            $result = $employee->row_array();

            $this->session->set_userdata(UserModel::$SESSION_ROLE,UserModel::$TYPE_EMPLOYEE);
            $this->session->set_userdata(UserModel::$SESSION_EMAIL,$result["emp_email"]);
            $this->session->set_userdata(UserModel::$SESSION_ID,$result["emp_id"]);
            $this->session->set_userdata(UserModel::$SESSION_NAME,$result["emp_name"]);
            $this->session->set_userdata(UserModel::$SESSION_AVATAR,$result["emp_avatar"]);
            $this->session->set_userdata(UserModel::$SESSION_STATUS,$result["emp_status"]);
            $this->session->set_userdata(UserModel::$SESSION_PROVIDER,$result["emp_oauth_provider"]);

            $this->load->model("EmployeeActivityModel", "employee_activity_model");
            $this->employee_activity_model->activity_login($result["emp_id"]);

            return array(
                "login"     => true,
                "status"    => $result["emp_status"],
                "name"      => $result["emp_name"],
                "token"     => $result["emp_token"],
                "role"      => "employee"
            );
        }
        return false;
    }

    public function destroy()
    {
        $this->session->unset_userdata(UserModel::$SESSION_ROLE);
        $this->session->unset_userdata(UserModel::$SESSION_EMAIL);
        $this->session->unset_userdata(UserModel::$SESSION_ID);
        $this->session->unset_userdata(UserModel::$SESSION_AVATAR);
        $this->session->unset_userdata(UserModel::$SESSION_NAME);
        $this->session->unset_userdata(UserModel::$SESSION_STATUS);
    }

    public function reset_password($role, $email, $token, $password)
    {
        if($role == UserModel::$TYPE_COMPANY)
        {
            $this->load->model("CompanyModel","company_model");
            if($this->company_model->read_by_token($token) != null){
                return $this->db->update(CompanyModel::$table_name,
                    array("cmp_password"=>md5($password)),
                    array("cmp_email"=>$email, "cmp_token"=>$token));
            }
        }
        else if($role == UserModel::$TYPE_EMPLOYEE)
        {
            $this->load->model("EmployeeModel","employee_model");
            if($this->employee_model->read_by_token($token) != null){
                return $this->db->update(EmployeeModel::$table_name,
                    array("emp_password"=>md5($password)),
                    array("emp_email"=>$email, "emp_token"=>$token));
            }
        }
        return false;
    }
}