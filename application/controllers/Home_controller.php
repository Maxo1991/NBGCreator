<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {
    public function index()
    {
        $this->load->library('form_validation');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('login');
        } else {
            $this->load->view('home');
        }
    }
}