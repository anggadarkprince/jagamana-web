<?php

/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 3/23/2015
 * Time: 10:18 PM
 */
class PeopleModel extends CI_Model
{
    public static $table_name = "jm_people";
    public static $primary_key = "plp_id";

    public static $foreign_company = "plp_company";

    public function __construct()
    {
        parent::__construct();

        $this->load->model("PeopleSectionModel", "people_section_model");
        $this->load->model("PeoplePhotoModel", "people_photo_model");
    }

    public function create($people)
    {
        $this->db->trans_start();

        $id = time();

        $people["plp_id"] = $id;

        $this->db->insert(PeopleModel::$table_name, $people);

        $this->people_section_model->create_default($id);

        $this->load->model("CompanyActivityModel", "company_activity_model");
        $this->company_activity_model->activity_people($people["plp_name"]);

        $this->db->trans_complete();

        return array(
            "status" => $this->db->trans_status(),
            "id" => $id
        );
    }

    public function read($id = null, $company = null)
    {
        if ($id == null) {
            $result = $this->db->get(PeopleModel::$table_name);
            return $result->result_array();
        } else {
            $condition = array(PeopleModel::$primary_key => $id);
            if($company != null){
                $condition[PeopleModel::$foreign_company] = $company;
            }
            $result = $this->db->get_where(PeopleModel::$table_name, $condition);
            return $result->row_array();
        }
    }

    public function read_by_company($company)
    {
        $condition = array(PeopleModel::$foreign_company => $company);
        $result = $this->db->get_where(PeopleModel::$table_name, $condition);
        return $result->result_array();
    }

    public function update($people, $id, $company = null)
    {
        $this->db->where(PeopleModel::$primary_key, $id);
        if($company != null){
            $this->db->where(PeopleModel::$foreign_company, $company);
        }
        return $this->db->update(PeopleModel::$table_name, $people);
    }

    public function delete($id)
    {
        $this->db->trans_start();

        # delete photos related by people
        $photo =  new PeoplePhotoModel();
        $photo->delete_by_people($id);

        #delete section related by people
        $section = new PeopleSectionModel();
        $section->delete_by_people($id);

        # remove the people itself
        $condition = array(PeopleModel::$primary_key => $id);
        $this->db->delete(PeopleModel::$table_name, $condition);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function delete_by_company($company)
    {
        # get all people related by company
        $people = $this->read_by_company($company);

        $this->db->trans_start();

        foreach ($people as $person):

            $this->delete($person["plp_id"]);

        endforeach;

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}