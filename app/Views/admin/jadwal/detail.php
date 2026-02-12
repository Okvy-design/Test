<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h3>Detail Kelas: <?= $kelas['nama_kelas']; ?></h3>
    <p><strong>Rentang Umur:</strong> <?= $kelas['rentang_umur_min']; ?> - <?= $kelas['rentang_umur_max']; ?> tahun</p>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Umur</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($anggota) > 0): ?>
                <?php $no=1; foreach($anggota as $a): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $a['nama']; ?></td>
                    <td><?= $a['umur']; ?></td>
                    <td>
                        <a href="<?= base_url('admin/jadwal/move_anggota/'.$a['id_anggota']); ?>" 
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-arrow-right"></i> Pindah Kelas
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" class="text-center">Tidak ada anggota di kelas ini.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div>
        <a href="<?= base_url('admin/jadwal/cetak/'.$kelas['id_kelas']); ?>" 
        class="btn btn-danger mb-3" target="_blank">
        <i class="fas fa-file-pdf"></i> Cetak PDF</a>
    </div>   
    <div>
    <a href="<?= base_url('admin/jadwal'); ?>" class="btn btn-secondary">Kembali</a>
    </div>

<?= $this->endSection(); ?>
