<?php
// HITUNG TOTAL & DP 30% - DARI SLIDE DOSEN
$total = $total ?? $total_sewa ?? 0;
if ($total == 0 && !empty($datacheckout)) {
    foreach ($datacheckout as $d) {
        $total += ($d['hrg_sewa'] ?? 0) * ($d['n_hari'] ?? 1);
    }
}
$dp = $total * 30 / 100;
$sisa = $total - $dp;
?>
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-12">

            <h6 class="mb-3">Checkout | Konfirmasi Sewa</h6>

            <!-- INFORMASI TRANSAKSI -->
            <div style="border:1px solid #ddd; padding:15px 20px; margin-bottom:20px; background:#fff;">
                <table style="width:100%; font-size:14px;">
                    <tr>
                        <td style="width:33%; padding:3px;">
                            Kode Sewa<br>
                            <b><?= $kode_sewa ?? '' ?></b>
                        </td>
                        <td style="width:33%; padding:3px;">
                            Status<br>
                            <?= $status_sewa ?? 'Keranjang' ?>
                        </td>
                        <td style="width:33%; padding:3px;">
                            Pelanggan<br>
                            <?= $NmPlg ?? $EmPlg ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:3px;">
                            Tanggal Mulai<br>
                            <b><?= $tgl_mulai ?? '' ?></b>
                        </td>
                        <td style="padding:3px;">
                            Tanggal Selesai<br>
                            <b><?= $tgl_selesai ?? '' ?></b>
                        </td>
                        <td style="padding:3px;">
                            Waktu Pengambilan<br>
                            <b><?= $wkt_ambil ?? '' ?></b>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ISI CHECKOUT -->
            <?php if (empty($datacheckout)) : ?>
                <div class="alert alert-warning">Checkout masih kosong!</div>
            <?php else : ?>
            <table style="width:100%; border-collapse:collapse; font-size:14px; background:#fff;">
                <thead>
                    <tr style="background:#f8f9fa;">
                        <th style="border:1px solid #dee2e6; padding:10px; text-align:left;">Kendaraan</th>
                        <th style="border:1px solid #dee2e6; padding:10px;">Nomor Polisi</th>
                        <th style="border:1px solid #dee2e6; padding:10px;">Harga per Hari</th>
                        <th style="border:1px solid #dee2e6; padding:10px;">Durasi</th>
                        <th style="border:1px solid #dee2e6; padding:10px;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datacheckout as $k) :
                        $merk = $k['nm_mobil'] ?? '-';
                        $foto = $k['ft_depan'] ?? '';
                        $hrg = $k['hrg_sewa'] ?? $k['hrg_hari'] ?? 0;
                        $hari = $k['n_hari'] ?? 1; if ($hari == 0) $hari = 1;
                        $sub = $hrg * $hari;
                    ?>
                    <tr>
                        <td style="border:1px solid #dee2e6; padding:10px;">
                            <img src="<?= base_url('img/' . rawurlencode($foto)) ?>" style="width:70px; height:45px; object-fit:cover; float:left; margin-right:10px;">
                            <span style="line-height:45px;"><b><?= $merk ?></b></span>
                        </td>
                        <td style="border:1px solid #dee2e6; padding:10px; text-align:center;"><?= $k['no_plat'] ?></td>
                        <td style="border:1px solid #dee2e6; padding:10px; text-align:center;">Rp <?= number_format($hrg, 0, ',', '.') ?></td>
                        <td style="border:1px solid #dee2e6; padding:10px; text-align:center;"><?= $hari ?> hari</td>
                        <td style="border:1px solid #dee2e6; padding:10px; text-align:center;">Rp <?= number_format($sub, 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>

            <!-- INI YANG BARU KAK - PERSIS KAYAK PUNYA DOSEN! -->
            <div style="border:1px solid #ddd; padding:20px; margin-top:20px; background:#fff; max-width:500px;">
                <h6 style="margin-bottom:15px; font-weight:bold;">Ringkasan Pembayaran</h6>
                <table style="width:100%; font-size:14px;">
                    <tr>
                        <td style="padding:8px 0;">Total Sewa</td>
                        <td style="padding:8px 0; text-align:right;"><b>Rp <?= number_format($total, 0, ',', '.') ?></b></td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0;">Uang Muka (DP 30%)</td>
                        <td style="padding:8px 0; text-align:right;"><b>Rp <?= number_format($dp, 0, ',', '.') ?></b></td>
                    </tr>
                    <tr style="border-top:1px solid #ddd;">
                        <td style="padding:10px 0;"><b>Sisa Pembayaran</b></td>
                        <td style="padding:10px 0; text-align:right;"><b>Rp <?= number_format($sisa, 0, ',', '.') ?></b></td>
                    </tr>
                </table>
                <p style="font-size:12px; color:#666; margin-top:10px; line-height:1.5;">
                    Pembayaran uang muka sebesar 30% dari total biaya sewa. Bukti pembayaran akan diunggah setelah transaksi diajukan dan diverifikasi oleh admin.
                </p>

                <div style="display:flex; justify-content:space-between; gap:10px; margin-top:15px;">
                    <a href="<?= base_url('c_shop/Sewa_C/keranjang') ?>">
                        <button type="button" style="background:#6c757d; color:#fff; border:none; padding:10px 15px; cursor:pointer;">Kembali ke Keranjang</button>
                    </a>

                    <!-- INI YANG PENTING KAK - FORM KE ajukantransaksi -->
                    <form action="<?= base_url('c_shop/Sewa_C/ajukantransaksi/' . $kode_sewa) ?>" method="post" style="margin:0;">
                        <input type="hidden" name="total_pembayaran" value="<?= $total ?>">
                        <input type="hidden" name="dp" value="<?= $dp ?>">
                        <button type="submit" style="background:#28a745; color:#fff; border:none; padding:10px 15px; cursor:pointer; font-weight:bold;">✅ Konfirmasi dan Ajukan Transaksi</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>