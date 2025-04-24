<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
    }

    // Function to get all students
    public function get_all_students() {
        $query = $this->db->get('student');
        return $query->result_array();
    }

    // Function to get a student by ID
    public function get_student_by_id($id) {
        $query = $this->db->get_where('student', array('id' => $id));
        return $query->row_array();
    }

    // Function to insert a new student
    public function insert_student($data) {
        return $this->db->insert('student', $data);
    }

    // Function to update a student
    public function update_student($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('student', $data);
    }

    // Function to delete a student
    public function delete_student($id) {
        $this->db->where('id', $id);
        return $this->db->delete('student');
    }
}