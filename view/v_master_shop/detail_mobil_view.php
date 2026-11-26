<!-- Detail Mobil Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Foto Mobil -->
        <div class="col-lg-5 pb-5">
            <div class="row">
                <div class="col-6">
                    <img class="w-100" src="<?= base_url('img/' . $mobil['ft_depan']) ?>" alt="<?= $mobil['nm_mobil'] ?>" style="height:250px; object-fit:cover;">
                </div>
                <div class="col-6">
                    <img class="w-100" src="<?= base_url('img/' . $mobil['ft_blkg']) ?>" alt="<?= $mobil['nm_mobil'] ?>" style="height:250px; object-fit:cover;">
                </div>
            </div>
        </div>

        <!-- Detail Mobil -->
        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold"><?= $mobil['nm_mobil'] ?></h3>
            <h5 class="font-weight-semi-bold mb-4">Rp <?= number_format($mobil['hrg_hari'], 0, ',', '.') ?> / hari</h5>

            <table class="table table-borderless">
                <tr>
                    <td>Nomor Plat</td>
                    <td>: <?= $mobil['no_plat'] ?></td>
                </tr>
                <tr>
                    <td>Jenis / Type</td>
                    <td>: <?= $mobil['jns_mobil'] ?></td>
                </tr>
                <tr>
                    <td>Transmisi</td>
                    <td>: <?= $mobil['transmisi'] ?></td>
                </tr>
                <tr>
                    <td>Tahun Buat</td>
                    <td>: <?= $mobil['thn_buat'] ?></td>
                </tr>
                <tr>
                    <td>Kapasitas Kursi</td>
                    <td>: <?= $mobil['nkursi'] ?> Orang</td>
                </tr>
                <tr>
                    <td>Kapasitas Bagasi</td>
                    <td>: <?= $mobil['nbagasi'] ?></td>
                </tr>
                <tr>
                    <td>Status Unit</td>
                    <td>: <span class="badge badge-success"><?= $mobil['status_unit'] ?></span></td>
                </tr>
            </table>

            <p class="font-weight-bold">Catatan Unit</p>
            <p><?= $mobil['cttn_unit'] ?></p>

           <div class="d-flex mt-4">
    <a href="<?= base_url('index.php?url=c_shop/Sewa_C/simpan/' . urlencode($mobil['no_plat'])) ?>"
   class="btn btn-primary mr-2">
    Pilih Sewa
</a>

    <a href="javascript:history.back()" class="btn btn-outline-secondary">
        Kembali
    </a>
</div>
        </div>
    </div>
</div>
<!-- Detail Mobil End -->