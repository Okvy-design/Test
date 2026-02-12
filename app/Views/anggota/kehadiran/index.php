<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4 border-left-success">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Kehadiran:</div>
                    <div class="h4 mb-0 font-weight-bold text-gray-800">
                        <?= $rekap['total_hadir'] ?? 0 ?> <small class="text-muted">Hadir</small>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4 border-left-danger">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Tidak Hadir:</div>
                    <div class="h4 mb-0 font-weight-bold text-gray-800">
                        <?= $rekap['total_tidak_hadir'] ?? 0 ?> <small class="text-muted">Sesi</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Kehadiran Anda</h6>
                    <a href="<?= base_url('anggota/kehadiran/detail') ?>" class="btn btn-info btn-sm">
                        Lihat Semua Pertemuan <i class="fas fa-search ml-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Anggota</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($anggota)) : ?>
                                <tr>
                                    <td><strong><?= esc($anggota['id_anggota']) ?></strong></td>
                                    <td><?= esc($anggota['nama']) ?></td>
                                    <td><span class="badge badge-success"><?= esc($anggota['nama_kelas'] ?? 'Belum Ditentukan') ?></span></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>