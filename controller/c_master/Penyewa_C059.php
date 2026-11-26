<?php
class Penyewa_C059 extends Controller
{
    public function index()
    {
        $cekdata = $this->load->model('m_master/Penyewa_M059');
        $dt['dtpenyewa'] = $cekdata->datapenyewa();

        $email = $this->session->userdata('emailuser');
        $info['nm_user'] = $email ? explode('@', $email)[0] : '';

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/penyewaview', $dt);
        $this->load->view('layout/footer');
    }

    public function create_penyewa()
    {
        $email = $this->session->userdata('emailuser');
        $info['nm_user'] = $email ? explode('@', $email)[0] : '';

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/create_penyewaview059');
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $penyewa = $this->load->model('m_master/Penyewa_M059');

        $user_plg059 = trim($this->load->post('user_plg059') ?? '');
        $sandi059 = trim($this->load->post('sandi059') ?? '');
        $nik059 = trim($this->load->post('nik059') ?? '');
        $nm_lngkp059 = trim($this->load->post('nm_lngkp059') ?? '');
        $no_hp059 = trim($this->load->post('no_hp059') ?? '');
        $almt_lngkp059 = trim($this->load->post('almt_lngkp059') ?? '');

        $ft_ktp = '';
        if (isset($_FILES['ft_ktp']) && $_FILES['ft_ktp']['error'] == 0) {
            $ft_ktp = $_FILES['ft_ktp']['name'];
            move_uploaded_file($_FILES['ft_ktp']['tmp_name'], 'img/' . $ft_ktp);
        }

        $ft_sim_a = '';
        if (isset($_FILES['ft_sim_a']) && $_FILES['ft_sim_a']['error'] == 0) {
            $ft_sim_a = $_FILES['ft_sim_a']['name'];
            move_uploaded_file($_FILES['ft_sim_a']['tmp_name'], 'img/' . $ft_sim_a);
        }

        $data = [
            'user_plg059' => $user_plg059,
            'Sandi059' => $sandi059,
            'Nik059' => $nik059,
            'nm_lngkp059' => $nm_lngkp059,
            'no_hp059' => $no_hp059,
            'almt_lngkp059' => $almt_lngkp059,
            'ft_ktp' => $ft_ktp,
            'ft_sim_a' => $ft_sim_a
        ];

        $penyewa->simpan($data);
        echo "<script>alert('Data Berhasil Disimpan!'); window.location.href = '" . base_url('c_master/Penyewa_C059/index') . "';</script>";
    }

    public function edit($nik059 = null)
    {
        if (empty($nik059)) {
            echo "<script>alert('NIK tidak ditemukan!'); window.location.href = '" . base_url('c_master/Penyewa_C059/index') . "';</script>";
            return;
        }

        $penyewa = $this->load->model('m_master/Penyewa_M059');
        $dt['penyewa'] = $penyewa->detailpenyewa($nik059);

        if (empty($dt['penyewa'])) {
            echo "<script>alert('Data tidak ditemukan!'); window.location.href = '" . base_url('c_master/Penyewa_C059/index') . "';</script>";
            return;
        }

        $email = $this->session->userdata('emailuser');
        $info['nm_user'] = $email ? explode('@', $email)[0] : '';

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/update_penyewaview059', $dt);
        $this->load->view('layout/footer');
    }

    public function UpdatePenyewa()
    {
        $penyewa = $this->load->model('m_master/Penyewa_M059');

        $user_plg059 = trim($this->load->post('user_plg059') ?? '');
        $sandi059 = trim($this->load->post('sandi059') ?? '');
        $nik059 = trim($this->load->post('nik059') ?? '');
        $nik_lama059 = trim($this->load->post('nik_lama059') ?? $nik059);
        $nm_lngkp059 = trim($this->load->post('nm_lngkp059') ?? '');
        $no_hp059 = trim($this->load->post('no_hp059') ?? '');
        $almt_lngkp059 = trim($this->load->post('almt_lngkp059') ?? '');

        $data_lama = $penyewa->detailpenyewa($nik_lama059);
        $data_lama = $data_lama ? (array) $data_lama : [];

        $ft_ktp = $data_lama['ft_ktp'] ?? $data_lama['Ft_ktp'] ?? '';
        if (isset($_FILES['ft_ktp']) && $_FILES['ft_ktp']['error'] == 0) {
            $ft_ktp = $_FILES['ft_ktp']['name'];
            move_uploaded_file($_FILES['ft_ktp']['tmp_name'], 'img/' . $ft_ktp);
        }

        $ft_sim_a = $data_lama['ft_sim_a'] ?? $data_lama['Ft_sim_a'] ?? '';
        if (isset($_FILES['ft_sim_a']) && $_FILES['ft_sim_a']['error'] == 0) {
            $ft_sim_a = $_FILES['ft_sim_a']['name'];
            move_uploaded_file($_FILES['ft_sim_a']['tmp_name'], 'img/' . $ft_sim_a);
        }

        $data = [
            'user_plg059' => $user_plg059,
            'Sandi059' => $sandi059,
            'Nik059' => $nik059,
            'nm_lngkp059' => $nm_lngkp059,
            'no_hp059' => $no_hp059,
            'almt_lngkp059' => $almt_lngkp059,
            'ft_ktp' => $ft_ktp,
            'ft_sim_a' => $ft_sim_a
        ];

        $penyewa->ubahPenyewa($data, $nik_lama059);
        echo "<script>alert('Data Berhasil Diupdate!'); window.location.href = '" . base_url('c_master/Penyewa_C059/index') . "';</script>";
    }

    public function hapus($nik059 = null)
    {
        if (empty($nik059)) {
            echo "<script>alert('NIK tidak ditemukan!'); window.location.href = '" . base_url('c_master/Penyewa_C059/index') . "';</script>";
            return;
        }

        $penyewa = $this->load->model('m_master/Penyewa_M059');
        $penyewa->HapusDtPenyewa($nik059);
        echo "<script>alert('Data Berhasil Dihapus!'); window.location.href = '" . base_url('c_master/Penyewa_C059/index') . "';</script>";
    }
}
?>