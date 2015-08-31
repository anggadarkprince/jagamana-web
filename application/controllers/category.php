<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/14/2015
 * Time: 2:40 PM
 */

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR)) {
            redirect(base_url());
        }

        $this->load->model("CategoryModel","category_model");

        $this->load->library('form_validation');
    }

    public function create()
    {
        if (!$this->_check_validation())
        {
            $this->_repopulate();
        }
        else
        {
            $data = array(
                "ctg_topic" => $this->input->post("jm-category-name"),
                "ctg_description" => $this->input->post("jm-category-description")
            );

            $result = $this->category_model->create($data);

            if($result)
            {
                $this->alert->success_alert("Category has been created successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("threads/categories");
        }
    }

    public function update($id)
    {
        if (!$this->_check_validation())
        {
            $this->_repopulate();
        }
        else
        {
            $data = array(
                "ctg_topic" => $this->input->post("jm-category-name"),
                "ctg_description" => $this->input->post("jm-category-description")
            );

            $result = $this->category_model->update($data, $id);

            if($result)
            {
                $this->alert->success_alert("Category has been updated successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("threads/categories");
        }
    }

    public function delete($id)
    {
        $result = $this->category_model->delete($id);

        if($result)
        {
            $this->alert->success_alert("Category has been removed successfully");
        }
        else
        {
            $this->alert->danger_alert("Something is getting wrong");
        }

        redirect("threads/categories");
    }

    private function _check_validation()
    {
        $this->form_validation->set_rules('jm-category-name', 'Category', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-category-description', 'Description', 'required|max_length[300]');

        return $this->form_validation->run();
    }

    private function _repopulate()
    {
        $data = array();
        $data["page"] = "Categories";
        $data["menu"] = "thread";
        $data["content"] = "administrator/pages/thread_category";
        $data["categories"] = $this->category_model->read();
        $data["operation"] = "warning";
        $data["message"] = validation_errors();

        $this->load->view("administrator/template", $data);
    }

}