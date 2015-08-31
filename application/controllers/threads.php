<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/14/2015
 * Time: 10:52 AM
 */

class Threads extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR)){
            redirect(base_url());
        }

        $this->load->model("ThreadModel", "thread_model");
        $this->load->model("CategoryModel", "category_model");
        $this->load->model("CommentModel", "comment_model");
        $this->load->library("form_validation");
    }

    public function index()
    {
        $data = array(
            "page" => "Threads",
            "menu" => "thread",
            "content" => "administrator/pages/threads",
            "threads" => $this->thread_model->read()
        );

        $this->load->view("administrator/template", $data);
    }

    public function categories()
    {
        $data = array(
            "page" => "Categories",
            "menu" => "thread",
            "content" => "administrator/pages/thread_category",
            "categories" => $this->category_model->read()
        );

        $this->load->view("administrator/template", $data);
    }

    public function comments()
    {
        $data = array(
            "page" => "Comments",
            "menu" => "thread",
            "content" => "administrator/pages/thread_comment",
            "comments" => $this->comment_model->read()
        );

        $this->load->view("administrator/template", $data);
    }

    public function delete_all()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $collectid = $this->input->post("checkid");

            $result = true;
            foreach($collectid as $id):
                $delete = $this->thread_model->delete($id);
                if(!$delete){
                    $result = false;
                }
            endforeach;

            if($result)
            {
                $this->alert->success_alert("Selected Threads has been removed successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("threads");
        }
        else
        {
            redirect("administrator");
        }
    }
}