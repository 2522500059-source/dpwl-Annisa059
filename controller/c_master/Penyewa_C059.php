
<?php
class Penyewa_C059 extends Controller
{
    public function index()
    {
        $cekdata = $this->load->model('m_master/Penyewa_M059');
        $dt['dtpenyewa'] = $cekdata->datapenyewa();
        $info['nm_user'] = explode('@', $this->session->userdata('emailuser'))[0];

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/penyewaview', $dt);
        $this->load->view('layout/footer');
    }

    public function create_penyewa()
    {
        $info['nm_user'] = explode('@', $this->session->userdata('emailuser'))[0];

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/create_penyewaview059');
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $penyewa = $this->load->model('m_master/Penyewa_M059');

        $user_plg059 = trim($this->load->post('user_plg059'));
        $Sandi059 = $this->load->post('Sandi059');
        $Nik059 = trim($this->load->post('Nik059'));
        $nm_lngkp059 = trim($this->load->post('nm_lngkp059'));
        $no_hp059 = trim($this->load->post('no_hp059'));
        $almt_lngkp059 = trim($this->load->post('almt_lngkp059'));

        // Validasi data
        if (
            empty($user_plg059) ||
            empty($Sandi059) ||
            empty($Nik059) ||
            empty($nm_lngkp059) ||
            empty($no_hp059) ||
            empty($almt_lngkp059)
        ) {
            echo "<script>alert('Semua data wajib diisi!'); window.history.back();</script>";
            exit;
        }

        // Memeriksa NIK
        if ($penyewa->ceknik($Nik059)) {
            echo "<script>alert('NIK sudah terdaftar!'); window.history.back();</script>";
            exit;
        }

        // Memeriksa upload foto
        if (
            !isset($_FILES['ft_ktp']) ||
            $_FILES['ft_ktp']['error'] != UPLOAD_ERR_OK
        ) {
            echo "<script>alert('Foto KTP wajib diupload!'); window.history.back();</script>";
            exit;
        }

        if (
            !isset($_FILES['ft_sim_a']) ||
            $_FILES['ft_sim_a']['error'] != UPLOAD_ERR_OK
        ) {
            echo "<script>alert('Foto SIM A wajib diupload!'); window.history.back();</script>";
            exit;
        }

        // Validasi ekstensi foto
        $ekstensi = strtolower(pathinfo($_FILES['ft_ktp']['name'], PATHINFO_EXTENSION));
        $ekstensi2 = strtolower(pathinfo($_FILES['ft_sim_a']['name'], PATHINFO_EXTENSION));

        if (!in_array($ekstensi, ['jpg', 'jpeg', 'png'])) {
            echo "<script>alert('Format foto KTP harus jpg, jpeg, atau png!'); window.history.back();</script>";
            exit;
        }

        if (!in_array($ekstensi2, ['jpg', 'jpeg', 'png'])) {
            echo "<script>alert('Format foto SIM A harus jpg, jpeg, atau png!'); window.history.back();</script>";
            exit;
        }

        // Folder penyimpanan gambar
        $folder = dirname(__DIR__, 2) . '/img/';

        if (!is_dir($folder)) {
            if (!mkdir($folder, 0777, true)) {
                echo "<script>alert('Folder gambar gagal dibuat!'); window.history.back();</script>";
                exit;
            }
        }

        $ft_ktp = 'KTP' . $Nik059 . '.' . $ekstensi;
        $ft_sim_a = 'SIM' . $Nik059 . '.' . $ekstensi2;

        // Upload foto KTP
        if (!move_uploaded_file($_FILES['ft_ktp']['tmp_name'], $folder . $ft_ktp)) {
            echo "<script>alert('Foto KTP gagal diupload!'); window.history.back();</script>";
            exit;
        }

        // Upload foto SIM A
        if (!move_uploaded_file($_FILES['ft_sim_a']['tmp_name'], $folder . $ft_sim_a)) {
            if (file_exists($folder . $ft_ktp)) {
                unlink($folder . $ft_ktp);
            }

            echo "<script>alert('Foto SIM A gagal diupload!'); window.history.back();</script>";
            exit;
        }

        // Data yang akan disimpan
        $data = [
            'user_plg059' => $user_plg059,
            'Sandi059' => $Sandi059,
            'Nik059' => $Nik059,
            'nm_lngkp059' => $nm_lngkp059,
            'no_hp059' => $no_hp059,
            'almt_lngkp059' => $almt_lngkp059,
            'ft_ktp' => $ft_ktp,
            'ft_sim_a' => $ft_sim_a
        ];

        // Menyimpan ke database
        $simpan = $penyewa->simpan($data);

        if ($simpan) {
            echo "<script>
                alert('Data penyewa berhasil disimpan!');
                window.location.href = '" . base_url('?url=c_master/Penyewa_C059/index') . "';
            </script>";
        } else {
            // Hapus foto jika penyimpanan database gagal
            if (file_exists($folder . $ft_ktp)) {
                unlink($folder . $ft_ktp);
            }

            if (file_exists($folder . $ft_sim_a)) {
                unlink($folder . $ft_sim_a);
            }

            echo "<script>
                alert('Data penyewa gagal disimpan! Periksa struktur tabel dan query database.');
                window.history.back();
            </script>";
        }

        exit;
    }

    public function edit($Nik059)
    {
        $info['nm_user'] = explode('@', $this->session->userdata('emailuser'))[0];

        $penyewa = $this->load->model('m_master/Penyewa_M059');
        $dt['penyewa'] = $penyewa->detailpenyewa($Nik059);

        if (!$dt['penyewa']) {
            echo "<script>alert('Data penyewa tidak ditemukan!'); window.history.back();</script>";
            exit;
        }

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/update_penyewaview059', $dt);
        $this->load->view('layout/footer');
    }

    public function UpdatePenyewa()
    {
        $penyewa = $this->load->model('m_master/Penyewa_M059');

        $Nik059 = $this->load->post('Nik059');

        $folder = dirname(__DIR__, 2) . '/img/';

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        // Foto KTP lama
        $ft_ktp = $this->load->post('ft_ktp_asli');

        if (isset($_FILES['ft_ktp']) && $_FILES['ft_ktp']['error'] != UPLOAD_ERR_NO_FILE) {
            if ($_FILES['ft_ktp']['error'] != UPLOAD_ERR_OK) {
                echo "<script>alert('Upload foto KTP gagal!'); window.history.back();</script>";
                exit;
            }

            $ekstensi = strtolower(pathinfo($_FILES['ft_ktp']['name'], PATHINFO_EXTENSION));

            if (!in_array($ekstensi, ['jpg', 'jpeg', 'png'])) {
                echo "<script>alert('Format foto KTP harus jpg, jpeg, atau png!'); window.history.back();</script>";
                exit;
            }

            $ft_ktp = 'KTP' . $Nik059 . '.' . $ekstensi;

            if (!move_uploaded_file($_FILES['ft_ktp']['tmp_name'], $folder . $ft_ktp)) {
                echo "<script>alert('Foto KTP gagal diupload!'); window.history.back();</script>";
                exit;
            }
        }

        // Foto SIM A lama
        $ft_sim_a = $this->load->post('ft_sim_a_asli');

        if (isset($_FILES['ft_sim_a']) && $_FILES['ft_sim_a']['error'] != UPLOAD_ERR_NO_FILE) {
            if ($_FILES['ft_sim_a']['error'] != UPLOAD_ERR_OK) {
                echo "<script>alert('Upload foto SIM A gagal!'); window.history.back();</script>";
                exit;
            }

            $ekstensi2 = strtolower(pathinfo($_FILES['ft_sim_a']['name'], PATHINFO_EXTENSION));

            if (!in_array($ekstensi2, ['jpg', 'jpeg', 'png'])) {
                echo "<script>alert('Format foto SIM A harus jpg, jpeg, atau png!'); window.history.back();</script>";
                exit;
            }

            $ft_sim_a = 'SIM' . $Nik059 . '.' . $ekstensi2;

            if (!move_uploaded_file($_FILES['ft_sim_a']['tmp_name'], $folder . $ft_sim_a)) {
                echo "<script>alert('Foto SIM A gagal diupload!'); window.history.back();</script>";
                exit;
            }
        }

        $data = [
            'user_plg059' => $this->load->post('user_plg059'),
            'Sandi059' => $this->load->post('Sandi059'),
            'Nik059' => $Nik059,
            'nm_lngkp059' => $this->load->post('nm_lngkp059'),
            'no_hp059' => $this->load->post('no_hp059'),
            'almt_lngkp059' => $this->load->post('almt_lngkp059'),
            'ft_ktp' => $ft_ktp,
            'ft_sim_a' => $ft_sim_a
        ];

        $simpan = $penyewa->ubahPenyewa($data);

        if ($simpan) {
            echo "<script>
                alert('Data penyewa berhasil diubah!');
                window.location.href = '" . base_url('?url=c_master/Penyewa_C059/index') . "';
            </script>";
        } else {
            echo "<script>alert('Data penyewa gagal diubah!'); window.history.back();</script>";
        }

        exit;
    }

    public function hapus($Nik059)
    {
        $penyewa = $this->load->model('m_master/Penyewa_M059');
        $dt = $penyewa->detailpenyewa($Nik059);

        if (!$dt) {
            echo "<script>alert('Data penyewa tidak ditemukan!'); window.history.back();</script>";
            exit;
        }

        $ft_ktp = $dt['ft_ktp'];
        $ft_sim_a = $dt['ft_sim_a'];

        $hapus = $penyewa->HapusDtPenyewa($Nik059);

        if ($hapus) {
            $folder = dirname(__DIR__, 2) . '/img/';

            if (!empty($ft_ktp) && file_exists($folder . $ft_ktp)) {
                unlink($folder . $ft_ktp);
            }

            if (!empty($ft_sim_a) && file_exists($folder . $ft_sim_a)) {
                unlink($folder . $ft_sim_a);
            }

            echo "<script>
                alert('Data penyewa berhasil dihapus!');
                window.location.href = '" . base_url('?url=c_master/Penyewa_C059/index') . "';
            </script>";
        } else {
            echo "<script>alert('Data penyewa gagal dihapus!'); window.history.back();</script>";
        }

        exit;
    }

    public function keluar()
    {
        $this->session->unset_userdata('emailuser');
        $this->session->set_flashdata('pesan', 'Berhasil Logout');
        redirect('Login_C/index');
        exit;
    }
}
