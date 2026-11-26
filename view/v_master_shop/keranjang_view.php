<?php
// DARI SLIDE 6 - PUNYA DOSEN
if (!empty($pesan)) {
    echo "<script>alert('" . $pesan . "');</script>";
}
$status_sewa = $datakeranjang[0]['status_sewa'] ?? $status_sewa ?? 'Keranjang';
?>
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-12">

            <h6 class="mb-3">Informasi Transaksi</h6>
            <form action="<?= base_url('c_s hop/Sewa_C/updatekeranjang') ?>" method="POST">
            <input type="hidden" name="kode_sewa" value="<?= htmlspecialchars($kode_sewa ?? '') ?>">
            <div style="border:1px solid #ddd; padding:15px 20px; margin-bottom:20px; background:#fff;">
                <table style="width:100%; font-size:14px;">
                    <tr>
                        <td style="width:33%; padding:3px; vertical-align:top;">
                            Kode Sewa<br>
                            <b><?= $kode_sewa ?? '' ?></b>
                        </td>
                        <td style="width:33%; padding:3px; vertical-align:top;">
                            Status<br>
                            <?= $status_sewa ?>
                        </td>
                        <td style="width:33%; padding:3px; vertical-align:top;">
                            Pelanggan<br>
                            <?= $NmPlg ?? $EmPlg ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:3px; vertical-align:top;">
                            Tanggal Transaksi<br>
                            <input type="date" name="tgl_mulai" value="<?= $tgl_mulai ?? date('Y-m-d') ?>" style="width:90%; padding:5px; border:1px solid #ccc;">
                        </td>
                        <td style="padding:3px; vertical-align:top;">
                            Tanggal Selesai<br>
                            <input type="date" name="tgl_selesai" value="<?= $tgl_selesai ?? date('Y-m-d') ?>" style="width:90%; padding:5px; border:1px solid #ccc;">
                        </td>
                        <td style="padding:3px; vertical-align:top;">
                            Waktu Pengambilan<br>
                            <input type="datetime-local" name="wkt_ambil" value="<?= $wkt_ambil ?? '' ?>" style="width:90%; padding:5px; border:1px solid #ccc;">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:3px; padding-top:10px;">
                            <button type="submit" style="background:#fff; color:#28a745; border:1px solid #28a745; padding:5px 10px; cursor:pointer;">✅ Update Keranjang</button>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            </form>

            <?php if (empty($keranjang)) : ?>
                <div class="alert alert-warning">Keranjang masih kosong!</div>
            <?php else : ?>

            <table style="width:100%; border-collapse:collapse; font-size:14px; background:#fff;">
                <thead>
                    <tr style="background:#f8f9fa;">
                        <th style="border:1px solid #dee2e6; padding:10px; text-align:left;">Kendaraan</th>
                        <th style="border:1px solid #dee2e6; padding:10px;">Nomor Polisi</th>
                        <th style="border:1px solid #dee2e6; padding:10px;">Harga per Hari</th>
                        <th style="border:1px solid #dee2e6; padding:10px;">Durasi</th>
                        <th style="border:1px solid #dee2e6; padding:10px;">Subtotal</th>
                        <th style="border:1px solid #dee2e6; padding:10px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; foreach ($keranjang as $k) :
                        $merk = $k['nm_mobil'] ?? '-';
                        $foto = $k['ft_depan'] ?? '';
                        $foto_enc = rawurlencode($foto);
                        $hrg = $k['hrg_sewa'] ?? $k['hrg_hari'] ?? 0;
                        $hari = $k['n_hari'] ?? 1; if ($hari == 0) $hari = 1;
                        $sub = $hrg * $hari; $total += $sub;
                    ?>
                    <tr>
                        <td style="border:1px solid #dee2e6; padding:10px; vertical-align:middle;">
                            <img src="<?= base_url('img/' . $foto_enc) ?>" style="width:70px; height:45px; object-fit:cover; float:left; margin-right:10px;">
                            <span style="line-height:45px;"><b><?= $merk ?></b></span>
                        </td>
                        <td style="border:1px solid #dee2e6; padding:10px; text-align:center; vertical-align:middle;"><?= $k['no_plat'] ?></td>
                        <td style="border:1px solid #dee2e6; padding:10px; text-align:center; vertical-align:middle;">Rp <?= number_format($hrg, 0, ',', '.') ?></td>
                        <td style="border:1px solid #dee2e6; padding:10px; text-align:center; vertical-align:middle;"><?= $hari ?> hari</td>
                        <td style="border:1px solid #dee2e6; padding:10px; text-align:center; vertical-align:middle;">Rp <?= number_format($sub, 0, ',', '.') ?></td>
                        <td style="border:1px solid #dee2e6; padding:10px; text-align:center; vertical-align:middle;">
                            <a href="<?= base_url('c_shop/Sewa_C/hapus/' . $k['no_plat'] . ',' . $kode_sewa) ?>" onclick="return confirm('Yakin mau hapus?')" style="color:#dc3545; border:1px solid #dc3545; padding:5px 10px; text-decoration:none;">🗑 Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" style="border:1px solid #dee2e6; padding:10px; text-align:right;"><b>Total Sewa</b></td>
                        <td colspan="2" style="border:1px solid #dee2e6; padding:10px; text-align:center;"><b>Rp <?= number_format($total, 0, ',', '.') ?></b></td>
                    </tr>
                </tbody>
            </table>
            <?php endif; ?>

            <div style="margin-top:15px;">
                <a href="<?= base_url('c_shop/Shop_C') ?>" style="display:block; background:#dc3545; color:#fff; text-align:center; padding:10px; text-decoration:none; font-weight:bold;">+ PILIH MOBIL</a>
                <a href="<?= base_url('c_shop/Sewa_C/checkout/' . $kode_sewa) ?>" style="display:block; background:#28a745; color:#fff; text-align:center; padding:10px; text-decoration:none; font-weight:bold; margin-top:8px;">Checkout | Lihat Konfirmasi</a>
            </div>

        </div>
    </div>
</div>