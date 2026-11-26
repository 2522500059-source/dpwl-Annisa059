<?php
class Sewa_M extends Model
{
    // Membuat kode sewa otomatis
    public function buat_kode_sewa()
    {
        $sql = $this->db->prepare(
            "SELECT MAX(CAST(SUBSTRING(kode_sewa, 3) AS UNSIGNED)) AS nomor
             FROM sewa"
        );
        $sql->execute();
        $hasil = $sql->get_result()->fetch_assoc();
        $nomor = ($hasil['nomor'] !== null)
            ? (int) $hasil['nomor'] + 1
            : 1;
        return 'SW' . str_pad($nomor, 5, '0', STR_PAD_LEFT);
    }

    // Simpan header 
    public function simpan($data_sewa)
    {
        // Simpan HEADER ke tabel sewa
        $sql = $this->db->prepare(
            "INSERT INTO sewa
        (kode_sewa, tgl_mulai, tgl_selesai, status_sewa, user_plg)
        VALUES (?, ?, ?, ?, ?)"
        );
        $sql->bind_param(
            "sssss",
            $data_sewa['kode_sewa'],
            $data_sewa['tgl_mulai'],
            $data_sewa['tgl_selesai'],
            $data_sewa['status_sewa'],
            $data_sewa['user_plg']
        );
        if ($sql->execute()) {
            return $data_sewa['kode_sewa'];
        } else {
            return false;
        }
    }

    // Simpan Detail
    
    public function simpandetail($data_pilih)
    {
    $sql = $this->db->prepare(
        "INSERT INTO pilih
        (kode_sewa, no_plat, hrg_sewa, n_hari)
        VALUES (?, ?, ?, ?)"
        );

    if (!$sql) {
        die("GAGAL PREPARE: " . $this->db->error);
        }

    $sql->bind_param(
        "ssdi",
        $data_pilih['kode_sewa'],
        $data_pilih['no_plat'],
        $data_pilih['hrg_sewa'],
        $data_pilih['n_hari']
        );

    if ($sql->execute()) {
        return $data_pilih['kode_sewa'];
        } else {
        die("GAGAL INSERT TABEL PILIH: " . $sql->error);
        }
    }
  

    public function CekTransaksi($email)
    {
        $sql = $this->db->prepare(
            "SELECT * FROM sewa where user_plg=? and status_sewa='Keranjang'"
        );
        $sql->bind_param("s", $email);
        $sql->execute();
        $hasil = $sql->get_result();
        $data = $hasil->fetch_assoc();
        return $data ? $data['kode_sewa'] : false;
    }

    // BUAT AMBIL HEADER SEWA - BIAR TANGGALNYA MUNCUL DI VIEW
    public function TampilSewa($kode)
    {
        $sql = $this->db->prepare("SELECT * FROM sewa WHERE kode_sewa = ?");
        $sql->bind_param("s", $kode);
        $sql->execute();
        $hasil = $sql->get_result();
        return $hasil->fetch_assoc();
    }

    public function CekDataPilih($kode, $no_plat)
    {
        $sql = $this->db->prepare(
            "SELECT * FROM pilih where kode_sewa=? and no_plat=?"
        );
        $sql->bind_param("ss", $kode, $no_plat);
        $sql->execute();
        $hasil = $sql->get_result();
        $data = $hasil->fetch_assoc();
        return $data ? $data['kode_sewa'] : false;
    }

    public function DataKeranjang($email)
    {
        $sql = $this->db->prepare(
            "SELECT sewa.kode_sewa, COUNT(pilih.no_plat) AS jumlah
            FROM sewa
            INNER JOIN pilih ON sewa.kode_sewa = pilih.kode_sewa
            WHERE sewa.user_plg = ?
            AND sewa.status_sewa = 'Keranjang'
            GROUP BY sewa.kode_sewa"
        );

        $sql->bind_param("s", $email);
        $sql->execute();

        $hasil = $sql->get_result();
        $data = $hasil->fetch_assoc();

        return $data ? $data['jumlah'] : 0;
    }

    // INI YANG BARU KAK - BUAT HITUNG JUMLAH DI HEADER
    public function HitungKeranjang($kode)
    {
        $sql = $this->db->prepare(
            "SELECT COUNT(*) AS jumlah FROM pilih WHERE kode_sewa = ?"
        );
        $sql->bind_param("s", $kode);
        $sql->execute();
        $hasil = $sql->get_result();
        $data = $hasil->fetch_assoc();
        return $data ? (int) $data['jumlah'] : 0;
    }

    // INI YANG UDAH AKU BENERIN - BUAT NAMPILIN ISI KERANJANG
    public function TampilKeranjang($kode)
    {
        $sql = $this->db->prepare(
            "SELECT pilih.*, mobil.*
            FROM pilih
            INNER JOIN mobil ON mobil.no_plat = pilih.no_plat
            WHERE pilih.kode_sewa = ?"
        );
        $sql->bind_param("s", $kode);
        $sql->execute();
        $hasil = $sql->get_result();
        $data = [];
        while ($row = $hasil->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // INI YANG BARU - BUAT TOMBOL HAPUS DI KERANJANG - UDAH DIGANTI JADI PUNYA DOSEN
    public function HapusDtKeranjang($no_plat, $kode_sewa)
    {
        $tampil = $this->db->prepare("DELETE FROM pilih WHERE no_plat = ? and kode_sewa=?");
        $tampil->bind_param("ss", $no_plat, $kode_sewa);
        $hasil = $tampil->execute();
        $tampil->close();
        return $hasil;
    }

    // INI YANG BARU - BUAT UPDATE JUMLAH HARI DI KERANJANG
    public function update_hari($kode, $no_plat, $hari)
    {
        $sql = $this->db->prepare("UPDATE pilih SET n_hari=? WHERE kode_sewa=? AND no_plat=?");
        $sql->bind_param("iss", $hari, $kode, $no_plat);
        return $sql->execute();
    }

    // INI YANG BARU - BUAT TOMBOL ✅ UPDATE KERANJANG - UDAH DIGANTI JADI PUNYA DOSEN
    public function UpdateKeranjang($kode_sewa, $tgl_mulai, $tgl_selesai, $wkt_ambil)
    {
        // Update tabel sewa
        $tampil = $this->db->prepare("UPDATE sewa SET tgl_mulai = ?, tgl_selesai = ?, wkt_ambil = ? WHERE kode_sewa = ?");
        $tampil->bind_param("ssss", $tgl_mulai, $tgl_selesai, $wkt_ambil, $kode_sewa);
        $tampil->execute();
        $tampil->close();

        // Update tabel pilih - hitung durasi
        $n_hari = (strtotime($tgl_selesai) - strtotime($tgl_mulai)) / (60 * 60 * 24) + 1;
        if ($n_hari < 1) $n_hari = 1;

        $tampil2 = $this->db->prepare("UPDATE pilih SET n_hari = ? WHERE kode_sewa = ?");
        $tampil2->bind_param("is", $n_hari, $kode_sewa);
        $hasil = $tampil2->execute();
        $tampil2->close();

        return $hasil;
    }

    // INI YANG BARU - SLIDE CHECKOUT - BUAT NAMPILIN ISI CHECKOUT - PUNYA DOSEN
    public function DataCheckout($kode_sewa)
    {
        $sql = "SELECT sewa.kode_sewa, sewa.tgl_mulai, sewa.tgl_selesai, sewa.wkt_ambil, sewa.status_sewa,
                pilih.no_plat, pilih.hrg_sewa, pilih.n_hari,
                mobil.nm_mobil, mobil.ft_depan
                FROM pilih
                INNER JOIN sewa ON sewa.kode_sewa = pilih.kode_sewa
                INNER JOIN mobil ON mobil.no_plat = pilih.no_plat
                WHERE pilih.kode_sewa = ?";
        $tampil = $this->db->prepare($sql);
        $tampil->bind_param("s", $kode_sewa);
        $tampil->execute();
        $hasil = $tampil->get_result()->fetch_all(MYSQLI_ASSOC);
        return $hasil;
    }

    // INI YANG BARU - SLIDE 7 - UBAH STATUS JADI DIAJUKAN - PUNYA DOSEN
    public function ajukantransaksi($kode_sewa)
    {
        $sql = "UPDATE sewa SET status_sewa = 'Diajukan' WHERE kode_sewa = ?";
        $tampil = $this->db->prepare($sql);
        $tampil->bind_param("s", $kode_sewa);
        $hasil = $tampil->execute();
        $tampil->close();
        return $hasil;
    }
}