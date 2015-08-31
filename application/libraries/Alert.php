<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 3:12 PM
 */

class Alert {

    private $CI;

    public function __construct()
    {
        $this->CI = get_instance();
    }

    public function success_alert($subject)
    {
        $this->CI->session->set_flashdata("jm-operation", "success");
        $this->CI->session->set_flashdata("jm-message", "<strong>Well done,</strong> $subject");
    }

    public function info_alert($subject)
    {
        $this->CI->session->set_flashdata("jm-operation", "info");
        $this->CI->session->set_flashdata("jm-message", "<strong>Info,</strong> $subject");
    }

    public function warning_alert($subject)
    {
        $this->CI->session->set_flashdata("jm-operation", "warning");
        $this->CI->session->set_flashdata("jm-message", "<strong>Warning,</strong> $subject");
    }

    public function danger_alert($subject)
    {
        $this->CI->session->set_flashdata("jm-operation", "danger");
        $this->CI->session->set_flashdata("jm-message", "<strong>Ouch,</strong> $subject");
    }

    public function flash_alert($operation, $message)
    {
        $this->CI->session->set_flashdata("jm-operation", $operation);
        $this->CI->session->set_flashdata("jm-message", $message);
    }

}