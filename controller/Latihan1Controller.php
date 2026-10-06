<?php

class Latihan1Controller extends Controller
{
    public function index()
    {
        $data['datamhs'] = $this->load->model('Latihan1Model')->getAllMhs();
        $this->session->set_userdata('nmuser', 'Fakhril');
        $data['nama_user'] = $this->session->userdata('nmuser');
        $this->load->view('latihan1view', $data);
    }
}