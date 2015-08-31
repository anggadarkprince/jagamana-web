<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/3/2015
 * Time: 8:15 PM
 */

class Comment extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommentModel", "comment_model");
    }

    public function submit()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('jm-comment-name', 'Name', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-comment-email', 'Email', 'required|valid_email|max_length[45]');
        $this->form_validation->set_rules('jm-comment-content', 'Comment', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->alert->warning_alert("Form Validation <br>".validation_errors());
        }
        else
        {
            $data = array(
                "cmt_thread" => $this->input->post("jm-comment-thread"),
                "cmt_name" => $this->input->post("jm-comment-name"),
                "cmt_email" => $this->input->post("jm-comment-email"),
                "cmt_comment" => $this->input->post("jm-comment-content"),
            );
            $result = $this->comment_model->create($data);

            if($result){
                $this->alert->success_alert("Comment submitted");
            } else {
                $this->alert->danger_alert("Something is getting wrong");
            }
        }

        redirect("forum/thread/".$this->input->post('jm-comment-permalink'));
    }

    public function delete($id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $result = $this->comment_model->delete($id);
            if($result)
            {
                $this->alert->success_alert("Comment has been removed successfully");
            }
            else{
                $this->alert->danger_aler("Something is getting wrong");
            }
            redirect("threads/comments");
        }
        else
        {
            redirect("error404");
        }
    }

}