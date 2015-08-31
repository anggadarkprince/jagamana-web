<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/23/2015
 * Time: 9:35 PM
 */
if(!defined('BASEPATH')) exit('No direct script access allowed');

class FacebookAuth
{
    public function __construct()
    {
		session_start();
        require_once('Facebook/autoload.php');
    }
}