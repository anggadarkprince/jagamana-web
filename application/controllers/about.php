<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/13/2015
 * Time: 7:35 PM
 */

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $data["page"] = "About";
        $data["menu"] = "about";
        $data["content"] = "administrator/pages/about";

        $this->load->view("administrator/template", $data);
    }

}