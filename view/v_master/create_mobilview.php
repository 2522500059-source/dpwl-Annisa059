<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('Mobil_C/index') ?>">Master Mobil</a></li>
                        <li class="breadcrumb-item active">Entri Mobil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-car"></i> Form Entri Data Mobil</h3>
                </div>
                <form action="<?= base_url('Mobil_C/simpan') ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label>No. Plat</label><input type="text" name="no_plat" class="form-control" required></div>
                                <div class="form-group"><label>Nama Mobil</label><input type="text" name="nm_mobil" class="form-control" required></div>
                                <div class="form-group"><label>Jumlah Kursi</label><input type="number" name="nkursi" class="form-control" required></div>
                                <div class="form-group"><label>Jenis Mobil</label><input type="text" name="jns_mobil" class="form-control"></div>
                                <div class="form-group"><label>Tahun Buat</label><input type="text" name="thn_buat" class="form-control"></div>
                                <div class="form-group"><label>Foto Depan</label><input type="file" name="ft_depan" class="form-control"></div>
                                <div class="form-group"><label>Harga/Hari</label><input type="number" name="hrg_hari" class="form-control"
                                placeholder="Masukkan biaya per hari" min="0" required>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group"><label>Jumlah Bagasi</label><input type="number" name="nbagasi" class="form-control"></div>
                                <div class="form-group"><label>Transmisi</label><select name="transmisi" class="form-control"><option>Manual</option><option>Automatic</option></select></div>
                                <div class="form-group"><label>Status</label><select name="status_unit" class="form-control"><option>Aktif</option><option>Tidak Aktif</option><option>Tersedia</option></select></div>
                                <div class="form-group"><label>Foto Belakang</label><input type="file" name="ft_blkg" class="form-control"></div>
                                <div class="form-group"><label>Foto Interior</label><input type="file" name="ft_interior" class="form-control"></div>
                                <div class="form-group"><label>Catatan</label><textarea name="cttn_unit" class="form-control"></textarea></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('Mobil_C/index') ?>" class="btn btn-secondary">kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>