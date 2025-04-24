<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Student_model', 'mod');
        $this->load->library('form_validation');
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
        header('Content-Type: application/json');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');    
        $this->form_validation->set_rules('faculty', 'Faculty', 'required');
        if ($this->form_validation->run() == FALSE) {
            $error = array(
                'name' => form_error('name'),
                'gender' => form_error('gender'),
                'phone' => form_error('phone'),
                'faculty' => form_error('faculty')
            );
            $res['status'] = 'error';
            $res['message'] = 'Error occurred';
            $res['error'] = $error;
            echo json_encode($res);
            return;
        }

        $data['name'] = $this->input->post('name');
        $data['gender'] = $this->input->post('gender');
        $data['phone'] = $this->input->post('phone');
        $data['faculty'] = $this->input->post('faculty');
        $this->mod->insert_student($data);
        $res['status'] = 'success';
        $res['message'] = 'Data successfully added';
        $res['data'] = $this->db->insert_id();
        echo json_encode($res);
    }

    public function api_edit()
    {
        header('Content-Type: application/json');
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
