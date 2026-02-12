<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4 border-left-success">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kelas Anda:</div>
                    <div class="h4 mb-0 font-weight-bold text-gray-800">
                        <?= esc($anggota['nama_kelas'] ?? 'Belum Ditentukan') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Waktu Latihan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                    <th>Sesi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($jadwal)) : ?>
                                    <?php foreach ($jadwal as $j) : ?>
                                        <tr>
                                            <td><strong><?= esc($j['hari']) ?></strong></td>
                                            <td><?= esc($j['waktu']) ?> WIB</td>
                                            <td><span class="badge badge-info"><?= esc($j['tipe_sesi']) ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Jadwal tidak ditemukan untuk kelas ini.</td>
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