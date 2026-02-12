<?= $this->extend('admin/layout'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Kelas</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
            <a href="<?= base_url('admin/kelas/tambah'); ?>" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah Kelas
            </a>
        </div>

        <div class="card-body">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php elseif (session()->getFlashdata('error')) : ?>
                <!-- Tampilkan pesan error (misalnya error hapus karena Foreign Key) -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped " id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>ID Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Tipe Kelas</th>
                            <th>Rentang Umur Min</th>
                            <th>Rentang Umur Max</th>
                            <th>Pelatih</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($kelas)): ?>
                            <?php $no = 1; foreach ($kelas as $k): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= esc($k['id_kelas']); ?></td>
                                    <td><?= esc($k['nama_kelas']); ?></td>
                                    <td><?= esc(ucwords($k['tipe_kelas'])); ?></td>
                                    <td class="text-center"><?= esc($k['rentang_umur_min']); ?></td>
                                    <td class="text-center"><?= esc($k['rentang_umur_max']); ?></td>
                                    <td><?= esc($k['nama_pelatih']); ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/kelas/edit/'.$k['id_kelas']); ?>" 
                                        class="btn btn-warning btn-circle btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('admin/kelas/hapus/'.$k['id_kelas']); ?>" 
                                            class="btn btn-danger btn-circle btn-sm " 
                                            onclick="return confirm('Yakin ingin hapus kelas ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada data kelas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>