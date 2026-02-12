<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">JADWAL KELOMPOK KELAS ANGGOTA</h1>
    <p class="mb-4">Daftar kelompok kelas Sanggar Gayatri Art</p>

    <!-- Card Wrapper -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
        </div>

        <div class="card-body">
            <!-- Pesan Sukses -->
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th >Nama Kelas</th>
                            <th>Rentang Umur</th>
                            <th>Pelatih</th>
                            <th>Jumlah Anggota</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($kelas)) : ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data kelas.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no=1; foreach($kelas as $k): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($k['nama_kelas']); ?></td>
                                    <td><?= esc($k['rentang_umur_min']); ?> - <?= esc($k['rentang_umur_max']); ?> tahun</td>
                                    <td><?= esc($k['nama_pelatih']); ?></td>
                                    <td><?= esc($k['jumlah_anggota']); ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/jadwal/detail/'.$k['id_kelas']); ?>" class="btn btn-info btn-circle btn-sm" title="lihat detail">
                                            <i class="fas fa-eye"></i> 
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
