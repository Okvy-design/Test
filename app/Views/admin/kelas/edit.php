<?= $this->extend('admin/layout'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3>Edit Kelas: ID <?= esc($kelas['id_kelas']); ?></h3>

    <!-- Flash Messages (Success and Error) -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php elseif(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <!-- End Flash Messages -->

    <form action="<?= base_url('admin/kelas/update/'.$kelas['id_kelas']); ?>" method="post">
        
        <!-- ID KELAS (DITAMPILKAN TAPI TIDAK DAPAT DIUBAH) -->
        <div class="form-group mb-3">
            <label>ID Kelas</label>
            <input type="text" value="<?= $kelas['id_kelas']; ?>" class="form-control" disabled>
            <small class="form-text text-muted">ID Kelas (KA001/KD001) tidak dapat diubah.</small>
        </div>

        <div class="form-group mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" value="<?= old('nama_kelas') ?? $kelas['nama_kelas']; ?>" class="form-control" required>
        </div>
        
        <!-- FIELD BARU: TIPE KELAS -->
        <div class="form-group mb-3">
            <label>Tipe Kelas</label>
            <select name="tipe_kelas" class="form-control" required>
                <?php 
                    $selectedTipe = old('tipe_kelas') ?? $kelas['tipe_kelas'];
                ?>
                <option value="anak" <?= $selectedTipe == 'anak' ? 'selected' : ''; ?>>Anak</option>
                <option value="dewasa" <?= $selectedTipe == 'dewasa' ? 'selected' : ''; ?>>Dewasa</option>
            </select>
        </div>
        <!-- AKHIR FIELD BARU -->

        <div class="form-group mb-3">
            <label>Rentang Umur Min</label>
            <input type="number" name="rentang_umur_min" value="<?= old('rentang_umur_min') ?? $kelas['rentang_umur_min']; ?>" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Rentang Umur Max</label>
            <input type="number" name="rentang_umur_max" value="<?= old('rentang_umur_max') ?? $kelas['rentang_umur_max']; ?>" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Pelatih</label>
            <select name="id_pelatih" class="form-control" required>
                <?php foreach ($pelatih as $p): ?>
                    <?php 
                        $selectedId = old('id_pelatih') ?? $kelas['id_pelatih'];
                        $isSelected = $p['id_pelatih'] == $selectedId ? 'selected' : ''; 
                    ?>
                    <option value="<?= $p['id_pelatih']; ?>" <?= $isSelected; ?>>
                        <?= $p['nama']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('admin/kelas'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection(); ?>