<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/25/2015
 * Time: 8:40 AM
 */

class UploaderModel extends CI_Model
{
    public static $TYPE_DOCUMENT = "pdf|xls|xlsx|doc|docx|txt";
    public static $TYPE_IMAGE = "jpg|jpeg|gif|png";
    public static $TYPE_VIDEO = "avi|mp4|flv|mkv|mpeg|mov|3gp";

    private $allowed_types = "";
    private $upload_path = "./";
    private $input_source = "userfile";
    private $max_size = 2000;
    private $max_width = 0;
    private $max_height = 0;
    private $file_name = "";
    private $overwrite = FALSE;

    private $error;
    private $uploader;

    public function __construct($data = null)
    {
        if($data != null && is_array($data)){
            extract($data, EXTR_OVERWRITE);
        }
    }

    public function config($data)
    {
        $this->file_name = $data["file_name"];
        $this->upload_path = $data["upload_path"];
        $this->input_source = $data["input_source"];
        $this->overwrite = $data["overwrite"];
        $this->allowed_types = $data["allowed_types"];

        if(isset($data["max_height"])){
            $this->max_height = $data["max_height"];
        }
        if(isset($data["max_width"])){
            $this->max_width = $data["max_width"];
        }

        $config = array(
            'allowed_types' => $this->allowed_types,
            'upload_path' => $this->upload_path,
            'max_size' => $this->max_size,
            'max_width' => $this->max_width,
            'max_height' => $this->max_height,
            'file_name' => $this->file_name,
            'overwrite' => $this->overwrite
        );

        $this->load->library('upload', $config);
        $this->uploader = new CI_Upload($config);
    }

    public function start_upload()
    {
        if (! $this->uploader->do_upload($this->input_source)) {
            $this->error =  $this->uploader->display_errors();
            return false;
        }
        return true;
    }

    public function upload_data()
    {
        return  $this->uploader->data();
    }

    public function upload_error()
    {
        return $this->error;
    }

}