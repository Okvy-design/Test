<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambahBiaya">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Jenis Biaya
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if(session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
            
            <form action="<?= base_url('admin/biaya/update') ?>" method="post">
                <?= csrf_field() ?>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Jenis Biaya</th>
                            <th>Jumlah (Rp)</th>
                            <th>Keterangan</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($biaya as $b): ?>
                        <tr>
                            <td>
                                <input type="text" name="biaya[<?= $b['id_biaya'] ?>][jenis_biaya]" class="form-control" value="<?= esc($b['jenis_biaya']) ?>" required>
                            </td>
                            <td>
                                <input type="number" name="biaya[<?= $b['id_biaya'] ?>][jumlah]" class="form-control" value="<?= esc(number_format($b['jumlah'], 0, '', '')) ?>" required>
                            </td>
                            <td>
                                <input type="text" name="biaya[<?= $b['id_biaya'] ?>][keterangan]" class="form-control" value="<?= esc($b['keterangan']) ?>">
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/biaya/delete/'.$b['id_biaya']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus biaya ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Semua Perubahan</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahBiaya" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/biaya/add') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jenis Biaya Baru</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Biaya</label>
                        <input type="text" name="jenis_biaya" class="form-control" placeholder="Contoh: Biaya Event" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>