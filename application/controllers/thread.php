<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/26/2015
 * Time: 10:59 PM
 */

class Thread extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)) {
            redirect(base_url());
        }

        $this->load->model("ThreadModel","thread_model");
        $this->load->model("CategoryModel","category_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $employee = $this->session->userdata(UserModel::$SESSION_ID);

        $data = array();
        $data["page"] = "Thread";
        $data["menu"] = "thread";
        $data["content"] = "website/pages/employee/threads";
        $data["threads"] = $this->thread_model->read_by_author(null, null, $employee);

        $this->load->view("website/template", $data);
    }

    private function _populate_data()
    {
        $this->form_validation->set_rules('jm-thread-title', 'Title', 'required|max_length[100]');
        $this->form_validation->set_rules('jm-thread-category', 'Category', 'required');
        $this->form_validation->set_rules('jm-thread-content', 'Content', 'required');
        $this->form_validation->set_rules('jm-thread-status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            return array(
                "status" => FALSE,
                "data" => null
            );
        }
        else{
            $thread = array();
            $thread["thr_title"] = $this->input->post("jm-thread-title");
            $thread["thr_content"] = $this->input->post("jm-thread-content");
            $thread["thr_category"] = $this->input->post("jm-thread-category");
            $thread["thr_status"] = $this->input->post("jm-thread-status");
            $thread["thr_author"] = $this->session->userdata(UserModel::$SESSION_ID);

            return array(
                "status" => TRUE,
                "data" => $thread
            );
        }
    }

    public function create()
    {
        $data = array();
        $data["page"] = "Create Thread";
        $data["menu"] = "thread";
        $data["content"] = "website/pages/employee/thread_create";
        $data["categories"] = $this->category_model->read();

        $this->load->view("website/template", $data);
    }

    public function save()
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
        {
            $thread = $this->_populate_data();

            if ($thread["status"] == FALSE)
            {
                $data = array();
                $data["page"] = "Create Thread";
                $data["menu"] = "thread";
                $data["content"] = "website/pages/employee/thread_create";
                $data["categories"] = $this->category_model->read();
                $data["operation"] = "warning";
                $data["message"] = validation_errors();
                $this->load->view("website/template", $data);
            }
            else
            {
                $result = $this->thread_model->create($thread["data"]);

                if($result)
                {
                    $this->alert->success_alert("New thread has been created successfully");
                }
                else
                {
                    $this->alert->danger_alert("Something is getting wrong");
                }

                redirect("thread");
            }
        }
        else
        {
            redirect("page/login");
        }
    }

    public function edit($permalink)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
        {
            if($this->_is_valid_permalink($permalink))
            {
                $thread_id = permalink_id($permalink);

                $data = array();
                $data["page"] = "Edit Thread";
                $data["menu"] = "thread";
                $data["categories"] = $this->category_model->read();
                $data["thread"] = $this->thread_model->read_by_id($thread_id);
                $data["content"] = "website/pages/employee/thread_edit";

                $this->load->view("website/template", $data);
            }
            else
            {
                $this->alert->danger_alert("Invalid permalink reference");
                redirect("thread");
            }
        }
        else
        {
            redirect("page/login");
        }
    }

    private function _is_valid_permalink($permalink)
    {
        $employee_id = $this->session->userdata(UserModel::$SESSION_ID);

        $valid_permalink = false;
        $threads = $this->thread_model->read_by_author($employee_id);

        foreach($threads as $thread):
            if($thread["permalink"] == $permalink)
            {
                $valid_permalink = true;
                break;
            }
        endforeach;

        return $valid_permalink;
    }

    public function update($permalink)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
        {
            if($this->_is_valid_permalink($permalink))
            {
                $thread = $this->_populate_data();

                if ($thread["status"] == FALSE)
                {
                    $data = array();
                    $data["page"] = "Edit Thread";
                    $data["menu"] = "thread";
                    $data["content"] = "website/pages/employee/threads_edit";
                    $data["categories"] = $this->category_model->read();
                    $data["operation"] = "warning";
                    $data["message"] = validation_errors();
                    $this->load->view("website/template", $data);
                }
                else
                {
                    $thread_id = permalink_id($permalink);

                    $result = $this->thread_model->update($thread["data"], $thread_id);

                    if($result)
                    {
                        $this->alert->success_alert("Thread has been updated successfully");
                    }
                    else
                    {
                        $this->alert->danger_alert("Something is getting wrong");
                    }
                    redirect("thread");
                }
            }
            else
            {
                $this->alert->danger_alert("Invalid permalink reference");
                redirect("thread");
            }
        }
        else{
            redirect("page/login");
        }
    }

    public function delete($permalink)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
        {
            if($this->_is_valid_permalink($permalink))
            {
                $thread_id = permalink_id($permalink);

                $result = $this->thread_model->delete($thread_id);

                if($result)
                {
                    $this->alert->success_alert("Thread has been removed successfully");
                }
                else
                {
                    $this->alert->danger_alert("Something is getting wrong");
                }
            }
            else
            {
                $this->alert->danger_alert("Invalid permalink reference");
            }

            redirect("thread");
        }
        else
        {
            redirect("page/login");
        }
    }

}