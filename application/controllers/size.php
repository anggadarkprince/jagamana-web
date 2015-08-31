<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/14/2015
 * Time: 2:40 PM
 */

class Size extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!UserModel::is_authorize(UserModel::$TYPE_ADMINISTRATOR)) {
            redirect(base_url());
        }

        $this->load->model("CompanySizeModel","size_model");

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
                "csz_size" => $this->input->post("jm-size-name"),
                "csz_description" => $this->input->post("jm-size-description")
            );

            $result = $this->size_model->create($data);

            if($result)
            {
                $this->alert->success_alert("Size has been created successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("companies/size");
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
                "csz_size" => $this->input->post("jm-size-name"),
                "csz_description" => $this->input->post("jm-size-description")
            );

            $result = $this->size_model->update($data, $id);

            if($result)
            {
                $this->alert->success_alert("Size has been updated successfully");
            }
            else
            {
                $this->alert->danger_alert("Something is getting wrong");
            }

            redirect("companies/size");
        }
    }

    public function delete($id)
    {
        $result = $this->size_model->delete($id);

        if($result)
        {
            $this->alert->success_alert("Size has been removed successfully");
        }
        else
        {
            $this->alert->danger_alert("Something is getting wrong");
        }

        redirect("companies/size");
    }

    private function _check_validation()
    {
        $this->form_validation->set_rules('jm-size-name', 'Size', 'required|max_length[45]');
        $this->form_validation->set_rules('jm-size-description', 'Description', 'required|max_length[200]');

        return $this->form_validation->run();
    }

    private function _repopulate()
    {
        $data = array();
        $data["page"] = "Companies Size";
        $data["menu"] = "company";
        $data["content"] = "administrator/pages/companies_size";
        $data["categories"] = $this->size_model->read();
        $data["operation"] = "warning";
        $data["message"] = validation_errors();

        $this->load->view("administrator/template", $data);
    }

}