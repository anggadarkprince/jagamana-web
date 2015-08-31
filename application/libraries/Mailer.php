<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/4/2015
 * Time: 7:35 PM
 */
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mailer
{
    public function __construct()
    {
        require_once('PHPMailer/PHPMailerAutoload.php');
    }
}