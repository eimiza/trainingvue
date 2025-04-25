<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, or helpers here
    }

    public function index() {
        // Load a view for the controller
        $this->load->view('assign');
    }

    public function example_method() {
        // Example method
        echo "This is an example method in the Assign controller.";
    }
}