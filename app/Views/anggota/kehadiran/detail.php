<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Detail Riwayat Kehadiran Per Sesi</h6>
                <a href="<?= base_url('anggota/kehadiran') ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pertemuan</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($detail)) : ?>
                                <?php $no = 1; foreach ($detail as $d) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= date('d-m-Y', strtotime($d['tanggal_pertemuan'])) ?></td>
                                        <td>
                                            <?php if ($d['status_kehadiran'] == 'hadir') : ?>
                                                <span class="badge badge-success">HADIR</span>
                                            <?php else : ?>
                                                <span class="badge badge-danger"><?= $d['status_kehadiran'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $d['keterangan'] ?: '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data riwayat pertemuan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>