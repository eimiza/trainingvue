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
        $search = $this->input->post('search');
        $sel_gender = $this->input->post('sel_gender');
        $where = [];
        if($sel_gender){$where['gender'] = $sel_gender;}
        $data = $this->mod->get_all_students($where, $search);
        echo json_encode($data);
    }

    public function api_add()
    {
        header('Content-Type: application/json');
        $form = $this->input->post('form');
        
        $data['name'] = $form['name'];
        $data['gender'] = $form['gender'];
        $data['phone'] = $form['phone'];
        $data['faculty'] = $form['faculty'];
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
