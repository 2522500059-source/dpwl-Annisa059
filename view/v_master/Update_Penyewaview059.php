<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Update Penyewa 059</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('c_master/Penyewa_C059/index') ?>">Master Penyewa</a></li>
                        <li class="breadcrumb-item active">Update 059</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <?php
                $penyewa = isset($penyewa) ? (array) $penyewa : [];
                $nik = $penyewa['Nik059'] ?? $penyewa['nik059'] ?? '';
                $user = $penyewa['user_plg059'] ?? $penyewa['User_plg059'] ?? '';
                $sandi = $penyewa['Sandi059'] ?? $penyewa['sandi059'] ?? '';
                $nama = $penyewa['nm_lngkp059'] ?? $penyewa['Nm_lngkp059'] ?? '';
                $hp = $penyewa['no_hp059'] ?? $penyewa['No_hp059'] ?? '';
                $alamat = $penyewa['almt_lngkp059'] ?? $penyewa['Almt_lngkp059'] ?? '';
                $ktp = $penyewa['ft_ktp'] ?? $penyewa['Ft_ktp'] ?? '';
                $sim = $penyewa['ft_sim_a'] ?? $penyewa['Ft_sim_a'] ?? '';
                ?>
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-edit"></i> Form Update - <?= htmlspecialchars($nik, ENT_QUOTES, 'UTF-8') ?> / <?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?></h3>
                </div>

                <form action="<?= base_url('c_master/Penyewa_C059/UpdatePenyewa') ?>" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="user_plg059" class="form-control" value="<?= htmlspecialchars($user, ENT_QUOTES, 'UTF-8') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="sandi059" class="form-control" value="<?= htmlspecialchars($sandi, ENT_QUOTES, 'UTF-8') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik059" class="form-control" value="<?= htmlspecialchars($nik, ENT_QUOTES, 'UTF-8') ?>" required>
                                    <input type="hidden" name="nik_lama059" value="<?= htmlspecialchars($nik, ENT_QUOTES, 'UTF-8') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nm_lngkp059" class="form-control" value="<?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" name="no_hp059" class="form-control" value="<?= htmlspecialchars($hp, ENT_QUOTES, 'UTF-8') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Foto KTP</label><br>
                                    <?php if (!empty($ktp)) : ?>
                                        <img src="<?= base_url('img/' . rawurlencode($ktp)) ?>" width="150" style="margin-bottom:10px;"><br>
                                    <?php endif; ?>
                                    <input type="file" name="ft_ktp" class="form-control">
                                    <small>Kosongkan jika tidak ganti</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat Lengkap</label>
                                    <textarea name="almt_lngkp059" class="form-control" rows="4" required><?= htmlspecialchars($alamat, ENT_QUOTES, 'UTF-8') ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Foto SIM A</label><br>
                                    <?php if (!empty($sim)) : ?>
                                        <img src="<?= base_url('img/' . rawurlencode($sim)) ?>" width="150" style="margin-bottom:10px;"><br>
                                    <?php endif; ?>
                                    <input type="file" name="ft_sim_a" class="form-control">
                                    <small>Kosongkan jika tidak ganti</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                        <a href="<?= base_url('c_master/Penyewa_C059/index') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>