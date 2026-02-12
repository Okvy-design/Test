<?= $this->extend('admin/layout'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3>Tambah Kelas</h3>
    
    <!-- Tampilkan Pesan Error (Jika ada dari Controller) -->
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/kelas/simpan'); ?>" method="post">
        <div class="form-group mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" required value="<?= old('nama_kelas'); ?>">
        </div>

        <!-- FIELD BARU: TIPE KELAS -->
        <div class="form-group mb-3">
            <label>Tipe Kelas</label>
            <select name="tipe_kelas" class="form-control" required>
                <option value="">-- Pilih Tipe Kelas --</option>
                <option value="anak" <?= old('tipe_kelas') == 'anak' ? 'selected' : ''; ?>>Anak</option>
                <option value="dewasa" <?= old('tipe_kelas') == 'dewasa' ? 'selected' : ''; ?>>Dewasa</option>
            </select>
        </div>
        <!-- AKHIR FIELD BARU -->

        <div class="form-group mb-3">
            <label>Rentang Umur Min (Tahun)</label>
            <input type="number" name="rentang_umur_min" class="form-control" required value="<?= old('rentang_umur_min'); ?>">
        </div>

        <div class="form-group mb-3">
            <label>Rentang Umur Max (Tahun)</label>
            <input type="number" name="rentang_umur_max" class="form-control" required value="<?= old('rentang_umur_max'); ?>">
        </div>

        <div class="form-group mb-3">
            <label>Pelatih</label>
            <select name="id_pelatih" class="form-control" required>
                <option value="">-- Pilih Pelatih --</option>
                <?php foreach ($pelatih as $p): ?>
                    <option value="<?= $p['id_pelatih']; ?>" <?= old('id_pelatih') == $p['id_pelatih'] ? 'selected' : ''; ?>>
                        <?= $p['nama']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/kelas'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection(); ?>