<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('admin/jadwal-sanggar/store') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="id_jadwal">ID Jadwal</label>
                    <input type="text" name="id_jadwal_display" id="id_jadwal" class="form-control" value="<?= esc($new_id) ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="id_kelas">Pilih Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="form-control <?= $validation->hasError('id_kelas') ? 'is-invalid' : '' ?>">
                        <option value="">-- Pilih Kelas --</option>
                        <?php foreach ($kelas as $k): ?>
                            <option value="<?= esc($k['id_kelas']) ?>" <?= old('id_kelas') == $k['id_kelas'] ? 'selected' : '' ?>>
                                <?= esc($k['nama_kelas']) ?> (<?= esc($k['tipe_kelas']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if($validation->hasError('id_kelas')): ?><div class="invalid-feedback"><?= $validation->getError('id_kelas') ?></div><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="hari">Hari</label>
                    <input type="text" name="hari" id="hari" class="form-control <?= $validation->hasError('hari') ? 'is-invalid' : '' ?>" value="<?= old('hari') ?>" placeholder="Contoh: Senin & Jumat">
                    <?php if($validation->hasError('hari')): ?><div class="invalid-feedback"><?= $validation->getError('hari') ?></div><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="text" name="waktu" id="waktu" class="form-control <?= $validation->hasError('waktu') ? 'is-invalid' : '' ?>" value="<?= old('waktu') ?>" placeholder="Contoh: 14.00 - 15.30">
                    <?php if($validation->hasError('waktu')): ?><div class="invalid-feedback"><?= $validation->getError('waktu') ?></div><?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="tipe_sesi">Tipe Sesi</label>
                    <select name="tipe_sesi" id="tipe_sesi" class="form-control <?= $validation->hasError('tipe_sesi') ? 'is-invalid' : '' ?>">
                        <option value="reguler" <?= old('tipe_sesi') == 'reguler' ? 'selected' : '' ?>>Reguler</option>
                        <option value="private" <?= old('tipe_sesi') == 'private' ? 'selected' : '' ?>>Private</option>
                    </select>
                    <?php if($validation->hasError('tipe_sesi')): ?><div class="invalid-feedback"><?= $validation->getError('tipe_sesi') ?></div><?php endif; ?>
                </div>
                
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="<?= base_url('admin/jadwal') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>