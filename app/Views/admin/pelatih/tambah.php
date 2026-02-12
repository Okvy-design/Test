<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h3>Tambah Pelatih</h3>
    
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <form action="<?= base_url('admin/pelatih/simpan'); ?>" method="post">
        
        <div class="mb-3">
            <label>ID Pelatih</label>
            <input type="text" name="id_pelatih" class="form-control bg-light font-weight-bold" 
                   value="<?= esc($id_pelatih_otomatis ?? old('id_pelatih') ?? 'Error') ?>" readonly required
                   title="ID ini dibuat otomatis: PA + Nomor Urut">
        </div>
        
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required value="<?= old('nama') ?>">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= old('alamat') ?></textarea>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required value="<?= old('no_hp') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('admin/pelatih'); ?>" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<?= $this->endSection(); ?>