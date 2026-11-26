<?php
class Shopping extends Controller
{
    public function index()
    {
        $cekdata = $this->load->model('m_master/Mobil_M');
        $dt['dtmobil'] = $cekdata->datamobil();
        $dt['EmPlg'] = $this->session->userdata('EmailPlg');
        $dt['NmPlg'] = $this->session->userdata('NmPlg');
        $dt['psn'] = $this->session->set_flashdata('pesan');
        $this->load->view('layoutshop/headershop', $dt);
        $this->load->view('layoutshop/menushop');
        $this->load->view('layoutshop/slidershop', $dt);
        $this->load->view('layoutshop/contentshop', $dt);
        $this->load->view('layoutshop/footershop');
    }

    public function detail($no_plat)
    {
        $no_plat = urldecode($no_plat); // FIX: BN%209856%20XX -> BN 9856 XX
        $cekdata = $this->load->model('m_master/Mobil_M');
        $dt['mobil'] = $cekdata->detailmobil($no_plat);
        $dt['EmPlg'] = $this->session->userdata('EmailPlg');
        $dt['NmPlg'] = $this->session->userdata('NmPlg');
        $this->load->view('layoutshop/headershop', $dt);
        $this->load->view('layoutshop/menushop');
        $this->load->view('v_master_Shop/detail_mobil_view', $dt);
        $this->load->view('layoutshop/footershop');
    }

    public function cart($no_plat)
    {
        $no_plat = urldecode($no_plat); // FIX: BN%209856%20XX -> BN 9856 XX
        $email = $this->session->userdata('EmailPlg');

        if (!$email) {
            echo "<script>
                alert('Silakan login terlebih dahulu!');
                window.history.back();
            </script>";
            exit;
        }

        $sewa = $this->load->model('m_shop/Sewa_M');

        $kode = $sewa->cektransaksi($email);

        if (!$kode) {
            $kode = $sewa->buat_kode_sewa();

            $data_sewa = [
                'kode_sewa' => $kode,
                'tgl_mulai' => date('Y-m-d'),
                'tgl_selesai' => date('Y-m-d'),
                'status_sewa' => 'Keranjang',
                'user_plg' => $email
            ];

            $hasil = $sewa->simpan($data_sewa);

            if (!$hasil) {
                echo "<script>
                    alert('Gagal menyimpan transaksi!');
                    window.history.back();
                </script>";
                exit;
            }
        }

        $cekdata = $sewa->cekdatapilih($kode, $no_plat);

        if (!$cekdata) {
            $hrgmobil = $this->load->model('m_master/Mobil_M');
            $ambilhrg = $hrgmobil->detailmobil($no_plat);

            if (!$ambilhrg) {
                echo "<script>
                    alert('Data mobil tidak ditemukan! Plat: " . $no_plat . "');
                    window.history.back();
                </script>";
                exit;
            }

            $data_pilih = [
                'kode_sewa' => $kode,
                'no_plat' => $no_plat,
                'hrg_sewa' => $ambilhrg['hrg_hari'],
                'n_hari' => 0
            ];

            $dtpilih = $sewa->simpandetail($data_pilih);

            if ($dtpilih !== false) {
                echo "<script>
                    alert('Mobil berhasil dimasukkan ke keranjang!');
                    window.location.href = '" . base_url() . "/?url=Shopping/index';
                </script>";
                exit;
            } else {
                echo "<script>
                    alert('Gagal memasukkan mobil ke keranjang!');
                    window.history.back();
                </script>";
                exit;
            }
        } else {
            echo "<script>
                alert('Mobil sudah dipilih!');
                window.location.href = '" . base_url() . "/?url=Shopping/index';
            </script>";
            exit;
        }
    }
}