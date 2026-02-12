<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Pengaturan Halaman Informasi</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/info-pendaftaran/update') ?>" method="post">
                <?= csrf_field() ?>
                
                <input type="hidden" name="id_info" value="<?= esc($info['id_info']) ?>">

                <h5 class="mt-3 mb-3 text-info">I. Konten Halaman Depan (Info Sanggar)</h5>

                <div class="form-group">
                    <label for="judul">Judul (Max 255 Karakter)</label>
                    <input type="text" name="judul" id="judul" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>" 
                        value="<?= old('judul') ?? esc($info['judul']) ?>">
                    <?php if($validation->hasError('judul')): ?><div class="invalid-feedback"><?= $validation->getError('judul') ?></div><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Sanggar</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : '' ?>" rows="4"><?= old('deskripsi') ?? esc($info['deskripsi']) ?></textarea>
                    <?php if($validation->hasError('deskripsi')): ?><div class="invalid-feedback"><?= $validation->getError('deskripsi') ?></div><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="langkah_gabung">Langkah-Langkah Bergabung (Pisahkan dengan baris baru/Enter)</label>
                    <textarea name="langkah_gabung" id="langkah_gabung" class="form-control <?= $validation->hasError('langkah_gabung') ? 'is-invalid' : '' ?>" rows="4" placeholder="Contoh:&#10;1. Klik tombol Daftar Sekarang.&#10;2. Isi data diri calon anggota secara lengkap.&#10;3. Kirim formulir dan tunggu konfirmasi."><?= old('langkah_gabung') ?? esc($info['langkah_gabung']) ?></textarea>
                    <?php if($validation->hasError('langkah_gabung')): ?><div class="invalid-feedback"><?= $validation->getError('langkah_gabung') ?></div><?php endif; ?>
                </div>

                <hr class="mt-5">
                
                <h5 class="mb-3 text-info">II. Jadwal Periode Pendaftaran</h5>
                
                <div class="form-group">
                    <label for="periode_pendaftaran">Nama Periode Pendaftaran</label>
                    <input type="text" name="periode_pendaftaran" id="periode_pendaftaran" class="form-control <?= $validation->hasError('periode_pendaftaran') ? 'is-invalid' : '' ?>" 
                        value="<?= old('periode_pendaftaran') ?? esc($info['periode_pendaftaran']) ?>" placeholder="Contoh: Periode Januari - Maret 2026">
                    <?php if($validation->hasError('periode_pendaftaran')): ?><div class="invalid-feedback"><?= $validation->getError('periode_pendaftaran') ?></div><?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tgl_mulai_daftar">Tanggal Mulai Pendaftaran</label>
                            <input type="date" name="tgl_mulai_daftar" id="tgl_mulai_daftar" class="form-control <?= $validation->hasError('tgl_mulai_daftar') ? 'is-invalid' : '' ?>" 
                                value="<?= old('tgl_mulai_daftar') ?? esc($info['tgl_mulai_daftar']) ?>">
                            <?php if($validation->hasError('tgl_mulai_daftar')): ?><div class="invalid-feedback"><?= $validation->getError('tgl_mulai_daftar') ?></div><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tgl_akhir_daftar">Tanggal Akhir Pendaftaran</label>
                            <input type="date" name="tgl_akhir_daftar" id="tgl_akhir_daftar" class="form-control <?= $validation->hasError('tgl_akhir_daftar') ? 'is-invalid' : '' ?>" 
                                value="<?= old('tgl_akhir_daftar') ?? esc($info['tgl_akhir_daftar']) ?>">
                            <?php if($validation->hasError('tgl_akhir_daftar')): ?><div class="invalid-feedback"><?= $validation->getError('tgl_akhir_daftar') ?></div><?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">Status Pendaftaran (Mengaktifkan/Menonaktifkan Info)</label>
                    <select name="status" id="status" class="form-control <?= $validation->hasError('status') ? 'is-invalid' : '' ?>">
                        <?php $selected_status = old('status') ?? esc($info['status']); ?>
                        <option value="aktif" <?= $selected_status == 'aktif' ? 'selected' : '' ?>>Aktif (Tampilkan di halaman depan)</option>
                        <option value="nonaktif" <?= $selected_status == 'nonaktif' ? 'selected' : '' ?>>Nonaktif (Sembunyikan atau biarkan default)</option>
                    </select>
                    <?php if($validation->hasError('status')): ?><div class="invalid-feedback"><?= $validation->getError('status') ?></div><?php endif; ?>
                </div>
                
                <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-save me-2"></i> Simpan Perubahan Informasi</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>