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
        $data = $this->mod->get_all_students();;
        echo json_encode($data);
    }
}
