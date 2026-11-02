```php
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('?url=c_master/Penyewa_C059/index') ?>">Master Penyewa</a>
                        </li>
                        <li class="breadcrumb-item active">Entri Penyewa</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user"></i> Form Entri Data Penyewa
                    </h3>
                </div>

                <form action="<?= base_url('?url=c_master/Penyewa_C059/simpan') ?>"
                      method="POST"
                      enctype="multipart/form-data">

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text"
                                           name="user_plg059"
                                           class="form-control"
                                           placeholder="Masukkan Username"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password"
                                           name="Sandi059"
                                           class="form-control"
                                           placeholder="Masukkan Password"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text"
                                           name="Nik059"
                                           class="form-control"
                                           maxlength="20"
                                           placeholder="Masukkan NIK"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text"
                                           name="nm_lngkp059"
                                           class="form-control"
                                           placeholder="Masukkan Nama Lengkap"
                                           required>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text"
                                           name="no_hp059"
                                           class="form-control"
                                           maxlength="20"
                                           placeholder="Masukkan Nomor HP"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label>Alamat Lengkap</label>
                                    <textarea name="almt_lngkp059"
                                              class="form-control"
                                              rows="3"
                                              placeholder="Masukkan Alamat Lengkap"
                                              required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Foto KTP</label>
                                    <input type="file"
                                           name="ft_ktp"
                                           class="form-control"
                                           accept="image/jpeg,image/png"
                                           required>
                                    <small class="text-muted">Format JPG, JPEG, PNG</small>
                                </div>

                                <div class="form-group">
                                    <label>Foto SIM A</label>
                                    <input type="file"
                                           name="ft_sim_a"
                                           class="form-control"
                                           accept="image/jpeg,image/png"
                                           required>
                                    <small class="text-muted">Format JPG, JPEG, PNG</small>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>

                        <a href="<?= base_url('?url=c_master/Penyewa_C059/index') ?>"
                           class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>
```