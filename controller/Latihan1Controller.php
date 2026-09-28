<?php

class Latihan1Controller extends Controller
{
    public function index()
    {
        $data['datahms'] = $this->load->model('Latihan1Model')->getAllMhs();
        $this->load->view('latihan1view', $data);
    }
}