<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Data Kehadiran</h1>
    <p class="mb-4">Isi tanggal pertemuan dan status kehadiran setiap anggota.</p>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('admin/kehadiran/save') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group row">
                    <label for="tanggal_pertemuan" class="col-sm-2 col-form-label">Tanggal Pertemuan</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control <?= (session('errors.tanggal_pertemuan')) ? 'is-invalid' : '' ?>" id="tanggal_pertemuan" name="tanggal_pertemuan" value="<?= old('tanggal_pertemuan', date('Y-m-d')) ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.tanggal_pertemuan') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pertemuan_ke" class="col-sm-2 col-form-label">Pertemuan Ke-</label>
                    <div class="col-sm-2">
                        <input type="number" min="1" class="form-control" name="pertemuan_ke" placeholder="Contoh: 1" required>
                    </div>
                </div>
                
                <h5 class="mt-4 mb-3">Daftar Anggota</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="anggotaTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-light">
                                <th width="5%">No</th>
                                <th>Nama Anggota</th>
                                <th>Kelas</th>
                                <th width="15%">Status Kehadiran</th>
                                <th>Keterangan (Opsional)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($anggota)): ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada anggota yang terdaftar atau berstatus aktif.</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; ?>
                                <?php foreach ($anggota as $a): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?= esc($a['nama']) ?>
                                            <!-- Field tersembunyi untuk ID -->
                                            <input type="hidden" name="anggota_id[]" value="<?= esc($a['id_anggota']) ?>">
                                            <input type="hidden" name="kelas_id[]" value="<?= esc($a['id_kelas']) ?>">
                                            
                                        </td>
                                        <td><?= esc($a['nama_kelas']) ?></td>
                                        <td>
                                            <select name="status[]" class="form-control form-control-sm">
                                                <option value="hadir" class="text-success">Hadir</option>
                                                <option value="sakit" class="text-warning">Sakit</option>
                                                <option value="izin" class="text-primary">Izin</option>
                                                <option value="tidak hadir" class="text-danger">Tanpa Keterangan</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="keterangan[]" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= old('keterangan.' . ($no - 2)) ?>">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <hr>
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                <a href="<?= base_url('admin/kehadiran') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
