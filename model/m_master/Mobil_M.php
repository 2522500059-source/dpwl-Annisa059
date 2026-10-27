
<?php
class Mobil_M extends Model
{
    function datamobil()
    {
        $dtmobil = $this->db->prepare("SELECT no_plat, nm_mobil, nkursi, nbagasi, jns_mobil, transmisi, thn_buat, ft_depan, ft_blkg, ft_interior, hrg_hari, cttn_unit, status_unit FROM mobil");
        $dtmobil->execute();
        return $dtmobil->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function cekplat($no_plat)
    {
        $sql = $this->db->prepare("SELECT no_plat FROM mobil WHERE no_plat = ?");
        $sql->bind_param("s", $no_plat);
        $sql->execute();
        return $sql->get_result()->num_rows > 0;
    }

    public function simpan($data)
    {
        foreach ($data as $k => $v) {
            if ($v === null) $data[$k] = '';
        }

        $data['hrg_hari'] = (float) str_replace('.', '', $data['hrg_hari']);

        $sql = $this->db->prepare("INSERT INTO mobil (no_plat, nm_mobil, nkursi, nbagasi, jns_mobil, transmisi, thn_buat, ft_depan, ft_blkg, ft_interior, hrg_hari, cttn_unit, status_unit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $sql->bind_param("ssssssssssdss",
            $data['no_plat'],
            $data['nm_mobil'],
            $data['nkursi'],
            $data['nbagasi'],
            $data['jns_mobil'],
            $data['transmisi'],
            $data['thn_buat'],
            $data['ft_depan'],
            $data['ft_blkg'],
            $data['ft_interior'],
            $data['hrg_hari'],
            $data['cttn_unit'],
            $data['status_unit']
        );

        return $sql->execute();
    }

    public function detailmobil($no_plat)
    {
        $sql = $this->db->prepare("SELECT no_plat, nm_mobil, nkursi, nbagasi, jns_mobil, transmisi, thn_buat, ft_depan, ft_blkg, ft_interior, hrg_hari, cttn_unit, status_unit FROM mobil WHERE no_plat = ?");
        $sql->bind_param("s", $no_plat);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    public function ubahMobil($data)
    {
        foreach ($data as $k => $v) {
            if ($v === null) $data[$k] = '';
        }

        $data['hrg_hari'] = (float) str_replace('.', '', $data['hrg_hari']);

        $stmt = $this->db->prepare("UPDATE mobil SET nm_mobil = ?, nkursi = ?, nbagasi = ?, jns_mobil = ?, transmisi = ?, thn_buat = ?, ft_depan = ?, ft_blkg = ?, ft_interior = ?, hrg_hari = ?, cttn_unit = ?, status_unit = ? WHERE no_plat = ?");

        $stmt->bind_param("sssssssssdsss",
            $data['nm_mobil'],
            $data['nkursi'],
            $data['nbagasi'],
            $data['jns_mobil'],
            $data['transmisi'],
            $data['thn_buat'],
            $data['ft_depan'],
            $data['ft_blkg'],
            $data['ft_interior'],
            $data['hrg_hari'],
            $data['cttn_unit'],
            $data['status_unit'],
            $data['no_plat']
        );

        return $stmt->execute();
    }

    public function HapusDtMobil($no_plat)
    {
        $dtmobil = $this->db->prepare("DELETE FROM mobil WHERE no_plat = ?");
        $dtmobil->bind_param("s", $no_plat);
        $hasil = $dtmobil->execute();
        $dtmobil->close();
        return $hasil;
    }
}
