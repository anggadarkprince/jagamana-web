<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 21/02/2015
 * Time: 22:26
 */

function get_setting($link){
    $CI = get_instance();
    $CI->load->model("SettingModel","model_setting");
    $setting = $CI->model_setting->read();
    return $setting[$link];
}

function get_new_company(){
    $CI = get_instance();
    $CI->load->model("CompanyModel","model_company");
    return $CI->model_company->get_new_company();
}

function get_new_employee(){
    $CI = get_instance();
    $CI->load->model("EmployeeModel","model_employee");
    return $CI->model_employee->get_new_employee();
}

function get_new_job(){
    $CI = get_instance();
    $CI->load->model("JobModel","model_job");
    return $CI->model_job->get_new_job();
}

function get_new_application(){
    $CI = get_instance();
    $CI->load->model("ApplicationModel","model_application");
    return $CI->model_application->get_new_application();
}

function unique_visitor(){
    $CI = get_instance();
    $CI->load->model("VisitorModel","model_visitor");
    $CI->model_visitor->check_visitor();
}

function last_job(){
    $CI = get_instance();
    $CI->load->model("JobModel","model_job");
    $result = $CI->model_job->read(0, 5,"ACTIVE");
    return $result;
}

function pretty_print($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}