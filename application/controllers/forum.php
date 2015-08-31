<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 5:31 PM
 */

class Forum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CategoryModel", "category_model");
        $this->load->model("ThreadModel", "thread_model");
        $this->load->model("CommentModel", "comment_model");
        $this->load->library("Pagination", "pagination");
    }

    public function index()
    {
        $data = array();
        $data["page"] = "Forum";
        $data["menu"] = "forum";
        $data["content"] = "website/pages/public/forum";
        $data["categories"] = $this->category_model->read(0, 26);
        $data["threads"] = $this->thread_model->read(0, 10, "PUBLISHED");

        $this->load->view("website/template", $data);
    }

    public function categories()
    {
        $data = array();
        $data["page"] = "All Category";
        $data["menu"] = "forum";
        $data["content"] = "website/pages/public/categories";
        $data["categories"] = $this->category_model->read();

        $this->load->view("website/template", $data);
    }

    public function category($permalink = null)
    {
        $valid_permalink = false;
        $categories = $this->category_model->read();
        foreach($categories as $category):
            if($category["permalink"] == $permalink){
                $valid_permalink = true;
                break;
            }
        endforeach;

        if($valid_permalink)
        {
            $category_id = permalink_id($permalink);
            $category = $this->category_model->read_by_id($category_id);
            $threads = $this->thread_model->read_by_category($this->uri->segment(4),10,$category_id,"PUBLISHED");
            $this->thread_model->read_by_category(null,null,$category_id,"PUBLISHED");

            $config['base_url'] = site_url().'forum/category/'.$this->uri->segment(3);
            $config['total_rows'] = $this->thread_model->get_thread_total();
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);

            $data = array();
            $data["page"] = "Category";
            $data["menu"] = "forum";
            $data["content"] = "website/pages/public/category";
            $data["category"] = $category;
            $data["threads"] = $threads;

            $this->load->view("website/template", $data);
        }
        else{
            redirect("Error404");
        }
    }

    public function threads()
    {
        $threads = $this->thread_model->read($this->uri->segment(3),10,"PUBLISHED");
        $this->thread_model->read(null,null,"PUBLISHED");

        $config['base_url'] = site_url().'forum/threads';
        $config['total_rows'] = $this->thread_model->get_thread_total();
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);

        $data = array();
        $data["page"] = "Threads";
        $data["menu"] = "forum";
        $data["content"] = "website/pages/public/threads";
        $data["threads"] = $threads;

        $this->load->view("website/template", $data);
    }

    public function thread($permalink)
    {
        $this->load->library('form_validation');

        $valid_permalink = false;
        $threads = $this->thread_model->read();
        foreach($threads as $thread):
            if($thread["permalink"] == $permalink){
                $valid_permalink = true;
                break;
            }
        endforeach;

        if($valid_permalink)
        {
            $thread_id = permalink_id($permalink);

            $this->thread_model->updated_reader_total($thread_id);

            $thread = $this->thread_model->read_by_id($thread_id);
            $comments = $this->comment_model->read_by_thread($thread_id);
            $data = array();

            $data["thread"] = $thread;
            $data["comments"] = $comments;
            $data["page"] = $data["thread"]["title"];
            $data["menu"] = "forum";
            $data["content"] = "website/pages/public/thread";


            $this->load->view("website/template", $data);
        }
        else{
            redirect("Error404");
        }
    }

}