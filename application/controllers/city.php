<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/10/2015
 * Time: 9:29 PM
 */

class City extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("CityModel","city_model");
    }

    public function read_json()
    {
        $state_id = $this->input->post("id_state");

        $city = $this->city_model->read_by_state($state_id);

        echo json_encode($city);
    }

}