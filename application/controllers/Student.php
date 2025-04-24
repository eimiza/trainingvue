<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Student_model', 'mod');
    }

	public function index()
	{
		$this->load->view('student');
	}

    public function api_student()
    {
        header('Content-Type: application/json');
        $data = $this->mod->get_all_students();
        echo json_encode($data);
    }

    public function api_add()
    {
        $data['name'] = $this->input->post('name');
        $data['gender'] = $this->input->post('gender');
        $data['phone'] = $this->input->post('phone');
        $data['faculty'] = $this->input->post('faculty');
        $this->mod->insert_student($data);
        echo json_encode($this->db->insert_id());
    }

    public function api_edit()
    {
        $id = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        $data['gender'] = $this->input->post('gender');
        $data['phone'] = $this->input->post('phone');
        $data['faculty'] = $this->input->post('faculty');
        $this->mod->update_student($id, $data);
    }

    public function api_delete()
    {
        $id = $this->input->post('id');
        $this->mod->delete_student($id);
    }

    public function api_delete_batch()
    {
        $id = $this->input->post('id');
        foreach ($id as $key => $value) {
            $this->mod->delete_student($value);
        }

    }
}
