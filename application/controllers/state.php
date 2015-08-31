<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/10/2015
 * Time: 9:07 PM
 */

class State extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("StateModel","state_model");
    }

    public function read_json()
    {
        $country_id = $this->input->post("id_country");

        $state = $this->state_model->read_by_country($country_id);

        echo json_encode($state);
    }

}