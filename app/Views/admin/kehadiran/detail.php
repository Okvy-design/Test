<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Detail Riwayat Kehadiran</h1>
    <p class="mb-4">Menampilkan riwayat kehadiran lengkap untuk anggota tertentu. Gunakan filter untuk mencari berdasarkan periode tertentu.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                Nama: <?= $anggota['nama'] ?> (<?= $anggota['nama_kelas'] ?>)
            </h6>
            <a href="<?= base_url('admin/kehadiran') ?>" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <form action="" method="GET" class="form-inline float-right">
                        <div class="form-group mr-2">
                            <label class="mr-2">Filter Periode:</label>
                            <select name="bulan" class="form-control form-control-sm">
                                <option value="">-- Semua Bulan --</option>
                                <?php foreach($list_bulan as $num => $name): ?>
                                    <option value="<?= $num ?>" <?= ($bulan_terpilih == $num) ? 'selected' : '' ?>><?= $name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <select name="tahun" class="form-control form-control-sm">
                                <option value="">-- Semua Tahun --</option>
                                <?php foreach($list_tahun as $year): ?>
                                    <option value="<?= $year ?>" <?= ($tahun_terpilih == $year) ? 'selected' : '' ?>><?= $year ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <?php if($bulan_terpilih || $tahun_terpilih): ?>
                            <a href="<?= base_url('admin/kehadiran/detail/' . $anggota['id_anggota']) ?>" class="btn btn-danger btn-sm ml-1">
                                <i class="fas fa-sync"></i> Reset
                            </a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Tanggal Pertemuan</th>
                            <th>Status Kehadiran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($details)) : ?>
                            <?php $no = 1; foreach ($details as $d) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <i class="fas fa-calendar-alt text-gray-400 mr-1"></i>
                                    <?= ($d['tanggal_pertemuan'] && $d['tanggal_pertemuan'] != '0000-00-00') 
                                        ? date('d F Y', strtotime($d['tanggal_pertemuan'])) 
                                        : 'Tanggal Tidak Tercatat'; ?>
                                </td>
                                <td>
                                    <?php if($d['status_kehadiran'] == 'hadir'): ?>
                                        <span class="badge badge-success px-3">
                                            <i class="fas fa-check-circle"></i> HADIR
                                        </span>
                                    <?php elseif(in_array($d['status_kehadiran'], ['sakit', 'izin'])): ?>
                                        <span class="badge badge-warning px-3">
                                            <i class="fas fa-info-circle"></i> <?= strtoupper($d['status_kehadiran']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-danger px-3">
                                            <i class="fas fa-times-circle"></i> TIDAK HADIR
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <small class="text-muted italic"><?= $d['keterangan'] ?: '-' ?></small>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <img src="<?= base_url('assets/img/undraw_no_data.svg') ?>" style="width:150px;" class="mb-3 d-block mx-auto">
                                    <p class="text-gray-500">Belum ada data kehadiran pada periode yang dipilih.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>