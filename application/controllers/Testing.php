<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load any required models, libraries, or helpers here
    }

    public function index() {
        $this->load->view('testing');
    }

    public function example() {
        // Example method
        echo "This is an example method in the Testing controller.";
    }
}