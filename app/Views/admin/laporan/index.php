<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="card shadow col-md-6">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Cetak Laporan Bulanan</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/laporan/cetak') ?>" method="post" target="_blank">
            <div class="form-group">
                <label>Pilih Bulan</label>
                <select name="bulan" class="form-control" required>
                    <?php foreach($list_bulan as $m => $name): ?>
                        <option value="<?= $m ?>"><?= $name ?></option>
                    <?php endforeach; ?>
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
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak PDF
            </button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>