<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

<?php $isEdit = isset($anggota); ?>

<div class="row">
    <div class="col-lg-12"> 
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card shadow mb-4">
            <div class="card-body">
                
                <form action="<?= $isEdit ? base_url('admin/anggota/update/'.$anggota['id_anggota']) : base_url('admin/anggota/store') ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?php if ($isEdit): ?>
                                <label>ID Anggota</label>
                                <input type="text" name="id_anggota" class="form-control" readonly value="<?= esc($anggota['id_anggota']) ?>" title="ID Anggota tidak dapat diubah">
                            <?php else: ?>
                                <label>ID Anggota</label>
                                <input type="text" name="id_anggota" class="form-control bg-light font-weight-bold" readonly 
                                    value="<?= isset($id_anggota_otomatis) ? esc($id_anggota_otomatis) : 'Error Generating ID' ?>"
                                    title="ID ini dibuat otomatis: YY.AXX.NNN">
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Daftar</label>
                            <input type="date" name="tgl_daftar" class="form-control" readonly value="<?= $isEdit ? esc($anggota['tgl_daftar']) : date('Y-m-d') ?>">
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" required value="<?= $isEdit ? esc($anggota['nama']) : old('nama') ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="menunggu" <?= $isEdit && $anggota['status']=='menunggu' ? 'selected' : (old('status')=='menunggu' ? 'selected' : '') ?>>Menunggu Verifikasi</option>
                                <option value="aktif" <?= $isEdit && $anggota['status']=='aktif' ? 'selected' : (old('status')=='aktif' ? 'selected' : '') ?>>Aktif</option>
                                <option value="tidak-aktif" <?= $isEdit && $anggota['status']=='tidak-aktif' ? 'selected' : (old('status')=='tidak-aktif' ? 'selected' : '') ?>>Tidak Aktif</option>
                                <option value="keluar" <?= $isEdit && $anggota['status']=='keluar' ? 'selected' : (old('status')=='keluar' ? 'selected' : '') ?>>Keluar</option>
                            </select>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="laki-laki" <?= $isEdit && trim($anggota['jenis_kelamin'] ?? '')=='laki-laki' ? 'selected' : (old('jenis_kelamin')=='laki-laki' ? 'selected' : '') ?>>Laki-laki</option>
                                <option value="perempuan" <?= $isEdit && trim($anggota['jenis_kelamin'] ?? '')=='perempuan' ? 'selected' : (old('jenis_kelamin')=='perempuan' ? 'selected' : '') ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Kelas</label>
                            <?php if ($isEdit): ?>
                                <select name="id_kelas" class="form-control" title="Kelas dapat diubah secara manual atau akan dihitung ulang jika Tanggal Lahir diubah">
                                    <option value="">-- Pilih Kelas --</option>
                                    <?php foreach ($kelas_list as $kelas): ?>
                                        <?php $selected = ($anggota['id_kelas'] ?? old('id_kelas')) == $kelas['id_kelas'] ? 'selected' : ''; ?>
                                        <option value="<?= esc($kelas['id_kelas']) ?>" <?= $selected ?>><?= esc($kelas['nama_kelas']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php else: ?>
                                <input type="text" class="form-control bg-info text-white font-weight-bold" readonly value="Kelas akan otomatis ditentukan " title="Kelas akan ditentukan otomatis oleh sistem">
                                <?php endif; ?>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3"><?= $isEdit ? esc($anggota['alamat']) : old('alamat') ?></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Pengalaman Tari</label>
                            <textarea name="pengalaman_tari" class="form-control" rows="3"><?= $isEdit ? esc($anggota['pengalaman_tari']) : old('pengalaman_tari') ?></textarea>
                        </div>
                    </div> 
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" required value="<?= $isEdit ? esc($anggota['tgl_lahir']) : old('tgl_lahir') ?>" onchange="hitungUmur(this.value)">
                        </div>
                        
                        <div class="col-md-4">
                            <label>Umur</label>
                            <input type="text" id="umur_otomatis" class="form-control" readonly 
                                value="<?= $isEdit ? esc($anggota['umur']) : '' ?>" 
                                title="Umur dihitung otomatis dari Tanggal Lahir">
                            <?php if ($isEdit): ?>
                                <input type="hidden" name="umur" value="<?= esc($anggota['umur']) ?>">
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-md-4">
                            <label>No HP</label>
                            <input type="text" name="no_hp" class="form-control" required value="<?= $isEdit ? esc($anggota['no_hp']) : old('no_hp') ?>">
                        </div>
                    </div> 
                    
                    <?php if (!$isEdit): // Hanya tampilkan saat mode tambah ?>
<div class="row">
    <div class="col-md-6 mb-3">
        <label>Username (Login)</label>
        <input type="text" name="username" class="form-control" required value="<?= old('username') ?>" placeholder="Contoh: anggota01">
    </div>
    
    <div class="col-md-6 mb-3">
        <label>Password Awal</label>
        <div class="input-group">
            <input type="password" name="password" id="password_input" class="form-control" required placeholder="Password awal untuk anggota">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="fas fa-eye"></i> </button>
            </div>
        </div>
        </div>
</div>
<?php else: // Mode Edit ?>
    <input type="hidden" name="id_user" value="<?= esc($anggota['id_user'] ?? '') ?>">
<?php endif; ?>
                        
<div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Dokumen Data Diri / Foto (File/Image/PDF)</label>
                            <input type="file" name="file" class="form-control-file">
                            <?php if ($isEdit && !empty($anggota['file'])): ?>
                                <small class="form-text text-muted">File Tersimpan: 
                                    <a href="<?= base_url('uploads/datadiri/' . $anggota['file']) ?>" target="_blank"><?= esc($anggota['file']) ?></a>
                                </small>
                                <input type="hidden" name="old_file" value="<?= esc($anggota['file']) ?>">
                            <?php endif; ?>
                        </div>
                    <div class="col-md-6 mb-3">
                            <label>Bukti Transfer (Image)</label>
                            <input type="file" name="bukti_tf" class="form-control-file">
                            <?php if ($isEdit && !empty($anggota['bukti_tf'])): ?>
                                <small class="form-text text-muted">Bukti Tersimpan: 
                                    <a href="<?= base_url('uploads/transfer/' . $anggota['bukti_tf']) ?>" target="_blank"><?= esc($anggota['bukti_tf']) ?></a>
                                </small>
                                <input type="hidden" name="old_bukti_tf" value="<?= esc($anggota['bukti_tf']) ?>">
                            <?php endif; ?>
                        </div>
                    </div> 
                    
                    <button class="btn btn-primary" type="submit"><?= $isEdit ? 'Update' : 'Simpan' ?></button>
                    <a href="<?= base_url('admin/anggota') ?>" class="btn btn-secondary">Batal</a>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi JavaScript untuk menghitung umur secara real-time (hanya untuk tampilan)
    function hitungUmur(tglLahir) {
        // ... (Kode hitungUmur yang sudah ada) ...
    }

    // Panggil fungsi saat halaman dimuat (untuk mode edit)
    document.addEventListener('DOMContentLoaded', function() {
        const tglLahirInput = document.querySelector('input[name="tgl_lahir"]');
        if (tglLahirInput && tglLahirInput.value) {
            hitungUmur(tglLahirInput.value);
        }
        
        // --- START: LOGIKA SHOW/HIDE PASSWORD ---
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password_input');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function (e) {
                // Toggle tipe atribut (text/password)
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle ikon (eye/eye-slash)
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash'); // Mata tertutup
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye'); // Mata terbuka
                }
            });
        }
        // --- END: LOGIKA SHOW/HIDE PASSWORD ---
    });
</script>
<?= $this->endSection() ?>