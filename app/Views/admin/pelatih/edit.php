<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h3>Edit Pelatih</h3>
    
    <!-- PERBAIKAN: Arahkan ke rute update, bukan simpan -->
    <form action="<?= base_url('admin/pelatih/update/' . $pelatih['id_pelatih']); ?>" method="post">
        
        <!-- BARU: ID Pelatih (Read-only) -->
        <div class="mb-3">
            <label>ID Pelatih</label>
            <input type="text" name="id_pelatih_readonly" class="form-control bg-light font-weight-bold" 
                   value="<?= esc($pelatih['id_pelatih']); ?>" readonly 
                   title="ID Pelatih tidak dapat diubah.">
            <!-- ID asli tidak perlu dikirim, karena sudah ada di URL segment -->
        </div>
        <!-- AKHIR BARU -->
        
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required value="<?= esc($pelatih['nama']); ?>">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= esc($pelatih['alamat']); ?></textarea>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required value="<?= esc($pelatih['no_hp']); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('admin/pelatih'); ?>" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<?= $this->endSection(); ?>