<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/13/2015
 * Time: 7:37 PM
 */

class Help extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $data["page"] = "Help";
        $data["menu"] = "help";
        $data["content"] = "administrator/pages/help";

        $this->load->view("administrator/template", $data);
    }
}