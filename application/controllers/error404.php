<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 22/02/2015
 * Time: 11:09
 */
class Error404 extends CI_Controller
{

    public function index()
    {
        $this->load->view('error404');
    }
}

/* End of file Error404.php */
/* Location: ./application/controllers/Error404.php */