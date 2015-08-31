<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/23/2015
 * Time: 7:53 PM
 */
if(!defined('BASEPATH')) exit('No direct script access allowed');

class TwitterAuth
{
    public function __construct()
    {
        require_once('TwitterOAuth/twitteroauth.php');
    }
}