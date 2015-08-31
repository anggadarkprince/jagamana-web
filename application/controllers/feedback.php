<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/13/2015
 * Time: 9:04 PM
 */

class Feedback extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("FeedbackModel", "feedback_model");
    }

    public function index()
    {
        $this->general();
    }

    public function general()
    {
        $data = array();
        $data["page"] = "Feedback";
        $data["menu"] = "feedback";
        $data["content"] = "administrator/pages/feedback";
        $data["feedback"] = $this->feedback_model->read("GENERAL");

        $this->load->view("administrator/template", $data);
    }

    public function important()
    {
        $data = array();
        $data["page"] = "Feedback";
        $data["menu"] = "feedback";
        $data["content"] = "administrator/pages/feedback_important";
        $data["feedback"] = $this->feedback_model->read("IMPORTANT");

        $this->load->view("administrator/template", $data);
    }

    public function submit_feedback()
    {
        $data_contact = array(
            "fdb_name" => $this->input->post("jm-feedback-name"),
            "fdb_email" => $this->input->post("jm-feedback-email"),
            "fdb_message" => $this->input->post("jm-feedback-message"),
        );

        $result = $this->feedback_model->create($data_contact);

        if($result){
            $this->alert->success_alert("Feedback submitted, thank you");
        } else {
            $this->alert->danger_alert("Something is getting wrong");
        }

        redirect("page/contact");
    }

    public function delete($destination, $id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $result = $this->feedback_model->delete($id);
            if($result){
                $this->alert->success_alert("Feedback has been removed successfully");
            }
            else{
                $this->alert->error_alert("Something is getting wrong");
            }

            redirect("feedback/$destination");
        }
        else
        {
            redirect("error404");
        }
    }

    public function archive($destination, $id)
    {
        if(UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR))
        {
            $state = "IMPORTANT";
            if($destination == "important"){
                $state = "GENERAL";
            }
            $data = array(
                "fdb_type" => $state
            );

            $result = $this->feedback_model->update($data, $id);

            if($result){
                $this->alert->success_alert("Feedback has been moved as important record");
            }
            else{
                $this->alert->error_alert("Something is getting wrong");
            }

            redirect("feedback/$destination");
        }
        else
        {
            redirect("error404");
        }
    }
}