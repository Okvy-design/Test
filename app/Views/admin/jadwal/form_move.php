<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pindahkan Anggota: <?= $anggota['nama']; ?></h6>
        </div>
        <div class="card-body">

        <div class="alert alert-info">
                Anggota saat ini berada di Kelas <?= esc($nama_kelas_saat_ini); ?> (Umur: <?= $anggota['umur']; ?> tahun).
            </div>
            
            <form action="<?= base_url('admin/jadwal/move_anggota_update/'.$anggota['id_anggota']); ?>" method="post">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="id_kelas">Pilih Kelas Tujuan:</label>
                    <select name="id_kelas" id="id_kelas" class="form-control" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php foreach($kelas_list as $kelas): ?>
                            <option value="<?= esc($kelas['id_kelas']); ?>">
                                <?= esc($kelas['nama_kelas']); ?> (Umur: <?= esc($kelas['rentang_umur_min']); ?> - <?= esc($kelas['rentang_umur_max']); ?> tahun)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Pindahkan Sekarang</button>
                <a href="<?= base_url('admin/jadwal/detail/'.$anggota['id_kelas']); ?>" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>