<?php
class Penyewa_M059 extends Model
{
    function datapenyewa()
    {
        $dtpenyewa = $this->db->prepare("SELECT user_plg059, Sandi059, Nik059, nm_lngkp059, no_hp059, almt_lngkp059, ft_ktp, ft_sim_a FROM penyewa");
        if (!$dtpenyewa) {
            die("Query data penyewa gagal: " . $this->db->error);
        }
        $dtpenyewa->execute();
        return $dtpenyewa->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function ceknik($Nik059)
    {
        $sql = $this->db->prepare("SELECT Nik059 FROM penyewa WHERE Nik059 = ?");
        if (!$sql) {
            die("Query cek NIK gagal: " . $this->db->error);
        }
        $sql->bind_param("s", $Nik059);
        $sql->execute();
        return $sql->get_result()->num_rows > 0;
    }

    public function simpan($data)
    {
        foreach ($data as $k => $v) {
            if ($v === null) $data[$k] = '';
        }
        $user = $data['user_plg059'] ?? $data['User_plg059'] ?? '';
        $sandi = $data['Sandi059'] ?? $data['sandi059'] ?? '';
        $nik = $data['Nik059'] ?? $data['nik059'] ?? '';
        $nama = $data['nm_lngkp059'] ?? $data['Nm_lngkp059'] ?? '';
        $hp = $data['no_hp059'] ?? $data['No_hp059'] ?? '';
        $alamat = $data['almt_lngkp059'] ?? $data['Almt_lngkp059'] ?? '';
        $ktp = $data['ft_ktp'] ?? $data['Ft_ktp'] ?? '';
        $sim = $data['ft_sim_a'] ?? $data['Ft_sim_a'] ?? '';

        $sql = $this->db->prepare("INSERT INTO penyewa (user_plg059, Sandi059, Nik059, nm_lngkp059, no_hp059, almt_lngkp059, ft_ktp, ft_sim_a) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$sql) {
            die("Query simpan penyewa gagal: " . $this->db->error);
        }
        $sql->bind_param("ssssssss", $user, $sandi, $nik, $nama, $hp, $alamat, $ktp, $sim);
        if (!$sql->execute()) {
            die("Data penyewa gagal disimpan: " . $sql->error);
        }
        return true;
    }

    public function detailpenyewa($Nik059)
    {
        $sql = $this->db->prepare("SELECT user_plg059, Sandi059, Nik059, nm_lngkp059, no_hp059, almt_lngkp059, ft_ktp, ft_sim_a FROM penyewa WHERE Nik059 = ?");
        if (!$sql) {
            die("Query detail penyewa gagal: " . $this->db->error);
        }
        $sql->bind_param("s", $Nik059);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    // INI YANG DIBENERIN - LINE 66
    public function ubahPenyewa($data, $Nik059)
    {
        foreach ($data as $k => $v) {
            if ($v === null) $data[$k] = '';
        }

        $user = $data['user_plg059'] ?? $data['User_plg059'] ?? '';
        $sandi = $data['Sandi059'] ?? $data['sandi059'] ?? '';
        $nama = $data['nm_lngkp059'] ?? $data['Nm_lngkp059'] ?? '';
        $hp = $data['no_hp059'] ?? $data['No_hp059'] ?? '';
        $alamat = $data['almt_lngkp059'] ?? $data['Almt_lngkp059'] ?? '';
        $ktp = $data['ft_ktp'] ?? $data['Ft_ktp'] ?? '';
        $sim = $data['ft_sim_a'] ?? $data['Ft_sim_a'] ?? '';

        $stmt = $this->db->prepare("UPDATE penyewa SET user_plg059 = ?, Sandi059 = ?, nm_lngkp059 = ?, no_hp059 = ?, almt_lngkp059 = ?, ft_ktp = ?, ft_sim_a = ? WHERE Nik059 = ?");
        if (!$stmt) {
            die("Query update penyewa gagal: " . $this->db->error);
        }

        $stmt->bind_param(
            "ssssssss",
            $user,
            $sandi,
            $nama,
            $hp,
            $alamat,
            $ktp,
            $sim,
            $Nik059
        );

        return $stmt->execute();
    }

    public function HapusDtPenyewa($Nik059)
    {
        $dtpenyewa = $this->db->prepare("DELETE FROM penyewa WHERE Nik059 = ?");
        if (!$dtpenyewa) {
            die("Query hapus penyewa gagal: " . $this->db->error);
        }
        $dtpenyewa->bind_param("s", $Nik059);
        $hasil = $dtpenyewa->execute();
        $dtpenyewa->close();
        return $hasil;
    }
}
?>