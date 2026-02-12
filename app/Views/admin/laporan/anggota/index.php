<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Anggota</h1>
    <div class="card shadow col-md-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Filter Cetak Anggota per Angkatan</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/laporan/cetak_anggota') ?>" method="post" target="_blank">
                <div class="form-group">
                    <label>Pilih Angkatan</label>
                    <select name="angkatan" class="form-control" required>
                        <option value="1">Angkatan 1 (Januari - Maret)</option>
                        <option value="2">Angkatan 2 (April - Juni)</option>
                        <option value="3">Angkatan 3 (Juli - September)</option>
                        <option value="4">Angkatan 4 (Oktober - Desember)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pilih Tahun</label>
                    <select name="tahun" class="form-control" required>
                        <?php foreach($list_tahun as $y): ?>
                            <option value="<?= $y ?>"><?= $y ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-print"></i> Cetak PDF Anggota
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>