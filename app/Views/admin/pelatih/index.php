<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">DATA PELATIH</h1>
    <p class="mb-4">Daftar pelatih yang terdaftar dalam sistem.</p>

    <!-- Card Wrapper -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <a href="<?= base_url('admin/pelatih/tambah'); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text">Tambah Pelatih</span>
            </a>
        </div>

        <div class="card-body">
            <!-- Flash Message -->
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>ID Pelatih</th> <!-- BARU: Kolom ID Pelatih -->
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pelatih)) : ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data pelatih.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; foreach ($pelatih as $p) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><span class="badge badge-primary"><?= esc($p['id_pelatih']); ?></span></td> <!-- BARU: Tampilkan ID Pelatih -->
                                    <td><?= esc($p['nama']); ?></td>
                                    <td><?= esc($p['alamat']); ?></td>
                                    <td><?= esc($p['no_hp']); ?></td>
                                    <td>
                                    <a href="<?= base_url('admin/pelatih/edit/' . $p['id_pelatih']); ?>" 
                                            class="btn btn-warning btn-circle btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i> 
                                        </a>
                                        <a href="<?= base_url('admin/pelatih/hapus/' . $p['id_pelatih']); ?>" 
                                            class="btn btn-danger btn-circle btn-sm" 
                                            onclick="return confirm('Yakin hapus data ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i> 
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>