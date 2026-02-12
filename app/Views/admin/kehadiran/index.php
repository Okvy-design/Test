<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">REKAP KEHADIRAN ANGGOTA</h1>
    <p class="mb-4">Daftar rekapitulasi kehadiran per pertemuan yang telah disimpan.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <a href="<?= base_url('admin/kehadiran/create') ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text">Tambah</span>
            </a>
            <div class="d-flex align-items-center">
                <form action="<?= base_url('admin/kehadiran') ?>" method="GET" class="form-inline">
                    <label class="mr-2">Cari:</label>
                    <select name="bulan" class="form-control mr-2">
                        <option value="">Bulan</option>
                        <?php foreach($list_bulan as $num => $name): ?>
                            <option value="<?= $num ?>" <?= ($bulan_terpilih == $num) ? 'selected' : '' ?>><?= $name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="tahun" class="form-control mr-2">
                        <option value="">Tahun</option>
                        <?php foreach($list_tahun as $year): ?>
                            <option value="<?= $year ?>" <?= ($tahun_terpilih == $year) ? 'selected' : '' ?>><?= $year ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-info">Cari</button>
                    <?php if($bulan_terpilih || $tahun_terpilih): ?>
                        <a href="<?= base_url('admin/kehadiran') ?>" class="btn btn-secondary ml-2">Reset</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <div class="card-body">
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
    <thead>
        <tr>
            <th>ID Anggota</th>
            <th>Nama Anggota</th>
            <th>Kelas</th>
            <th>Kehadiran (Hadir/Total)</th> 
            <th>Persentase</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($anggota as $a): 
           $rekap = $detailModel->getRekapPerAnggota($a['id_anggota'], $bulan_terpilih, $tahun_terpilih);
           $total_pertemuan = $rekap['total_hadir'] + $rekap['total_tidak_hadir'];
           ?>
        <tr>
            <td><?= $a['id_anggota'] ?></td>
            <td><?= $a['nama'] ?></td>
            <td><?= $a['nama_kelas'] ?></td>
            <td>
                <span class="text-success"><?= $rekap['total_hadir'] ?></span> / 
                <span class="text-dark"><?= $total_pertemuan ?></span> Pertemuan
            </td>
            <td>
                    <?php 
                        $persen = ($total_pertemuan > 0) ? ($rekap['total_hadir'] / $total_pertemuan) * 100 : 0;
                        $warna = ($persen < 75) ? 'danger' : 'success';
                    ?>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-<?= $warna ?>" style="width: <?= $persen ?>%"></div>
                    </div>
              <small><?= number_format($persen, 0) ?>%</small>
            </td>
            <td>
                <a href="<?= base_url('admin/kehadiran/detail/' . $a['id_anggota']) ?>" class="btn btn-info btn-sm">
                    Detail <i class="fas fa-search"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>