<?php
class Admin_C extends Controller
{
    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/starter');
        $this->load->view('layout/footer');
    }
}