<?php
class Mobil_C extends Controller
{
    public function index()
    {
        $info['nm_user'] = explode('@', $this->session->userdata('emailuser'))[0];
        $cekdata = $this->load->model('m_master/Mobil_M');
        $dt['dtmobil'] = $cekdata->datamobil();
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/mobilview', $dt);
        $this->load->view('layout/footer');
    }

    public function create_mobil()
    {
        $info['nm_user'] = explode('@', $this->session->userdata('emailuser'))[0];
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/create_mobilview');
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $mobil = $this->load->model('m_master/Mobil_M');
        if ($mobil->cekplat($this->load->post('no_plat'))) {
            echo "<script>
                alert('Nomor plat sudah terdaftar!');
                window.history.back();
            </script>";
            exit;
        }

        $ft_depan = 'Depan'. $this->load->post('no_plat');
        $ft_blkg = 'Belakang'. $this->load->post('no_plat');
        $ft_interior = 'Interior'. $this->load->post('no_plat');

        $namaFiledepan = '';

        $folder = dirname(__DIR__, 2) . '/img/';
        if (isset($_FILES['ft_depan']) && $_FILES['ft_depan']['error'] == 0) {
             $file = $_FILES['ft_depan'];
             $info = getimagesize($file['tmp_name']);
            $ext = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
    if ($info && isset($ext[$info['mime']]) && $file['size'] <= 2 * 1024 * 1024) {
        $namaFiledepan = $ft_depan . '.' . $ext[$info['mime']];
        move_uploaded_file($file['tmp_name'], $folder . $namaFiledepan);
    } else {
        echo "<script>alert('Gagal simpan gambar, cek ukuran dan format..!');</script>";
    }
}

        $data = [
            'no_plat' => $this->load->post('no_plat'),
            'nm_mobil' => $this->load->post('nm_mobil'),
            'nkursi' => $this->load->post('nkursi'),
            'nbagasi' => $this->load->post('nbagasi'),
            'jns_mobil' => $this->load->post('jns_mobil'),
            'transmisi' => $this->load->post('transmisi'),
            'thn_buat' => $this->load->post('thn_buat'),
            'ft_depan' => $namaFiledepan,
            'ft_blkg' => $ft_blkg,
            'ft_interior' => $ft_interior,
            'hrg_hari' => $this->load->post('hrg_hari'),
            'cttn_unit' => $this->load->post('cttn_unit'),
            'status_unit' => $this->load->post('status_unit')
        ];

        $simpan = $mobil->simpan($data);

        if ($simpan) {
            echo "<script>
                alert('Data mobil berhasil disimpan!');
                window.location.href = '". base_url('Mobil_C/index'). "';
            </script>";
        } else {
            echo "<script>
                alert('Data mobil gagal disimpan!');
                window.history.back();
            </script>";
        }
    }
}