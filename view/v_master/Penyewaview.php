
<div class="content-wrapper">

  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Penyewa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="#">Master Data</a>
            </li>
            <li class="breadcrumb-item active">Data Penyewa</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-body">

          <!-- Tombol Tambah Data -->
          <a href="<?= base_url('?url=c_master/Penyewa_C059/create_penyewa') ?>"
             class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Tambah Data Penyewa
          </a>

          <!-- Tabel Data Penyewa -->
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>NIK</th>
                  <th>Nama Lengkap</th>
                  <th>No. HP</th>
                  <th>Alamat</th>
                  <th>Foto KTP</th>
                  <th>Foto SIM A</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $no = 1;

                if (isset($dtpenyewa) && !empty($dtpenyewa)) :
                    foreach ($dtpenyewa as $p) :
                ?>

                <tr>
                  <td><?= $no++ ?></td>

                  <td>
                    <?= htmlspecialchars($p['user_plg059'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                  </td>

                  <td>
                    <?= htmlspecialchars($p['Nik059'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                  </td>

                  <td>
                    <?= htmlspecialchars($p['nm_lngkp059'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                  </td>

                  <td>
                    <?= htmlspecialchars($p['no_hp059'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                  </td>

                  <td>
                    <?= htmlspecialchars($p['almt_lngkp059'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                  </td>

                  <!-- Foto KTP -->
                  <td>
                    <?php if (!empty($p['ft_ktp'])) : ?>
                      <img
                        src="<?= base_url('img/' . rawurlencode($p['ft_ktp'])) ?>"
                        width="100"
                        height="70"
                        style="object-fit: cover;"
                        alt="Foto KTP">
                    <?php else : ?>
                      Tidak ada foto
                    <?php endif; ?>
                  </td>

                  <!-- Foto SIM A -->
                  <td>
                    <?php if (!empty($p['ft_sim_a'])) : ?>
                      <img
                        src="<?= base_url('img/' . rawurlencode($p['ft_sim_a'])) ?>"
                        width="100"
                        height="70"
                        style="object-fit: cover;"
                        alt="Foto SIM A">
                    <?php else : ?>
                      Tidak ada foto
                    <?php endif; ?>
                  </td>

                  <!-- Tombol Aksi -->
                  <td>
                    <a href="<?= base_url('?url=c_master/Penyewa_C059/edit/' . urlencode($p['Nik059'])) ?>"
                       class="btn btn-warning btn-sm">
                      <i class="fas fa-edit"></i> Edit
                    </a>

                    <a href="<?= base_url('?url=c_master/Penyewa_C059/hapus/' . urlencode($p['Nik059'])) ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin menghapus data penyewa ini?')">
                      <i class="fas fa-trash"></i> Hapus
                    </a>
                  </td>
                </tr>

                <?php
                    endforeach;
                else :
                ?>

                <tr>
                  <td colspan="9" class="text-center">
                    Data Penyewa Belum Ada
                  </td>
                </tr>

                <?php endif; ?>

              </tbody>
            </table>
          </div>

        </div>
      </div>

    </div>
  </section>
</div>
