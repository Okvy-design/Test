<div class="container-fluid">

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger border-left-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">Manajemen Profil Saya</h6>
            <a href="<?= base_url('anggota/profil') ?>" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Dashboard
            </a>
        </div>
        <div class="card-body">
            <?= form_open_multipart(base_url('anggota/profil/update_aktif')) ?>
                <div class="row">
                    <div class="col-md-5">
                        <div class="p-3 bg-light rounded border">
                            <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                                <i class="fas fa-lock mr-2"></i>Informasi Keanggotaan
                            </h6>
                            <div class="form-group mb-3">
                                <label class="small mb-1 font-weight-bold">ID Anggota</label>
                                <input type="text" class="form-control form-control-sm" value="<?= $anggota['id_anggota'] ?>" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1 font-weight-bold">Kelas Saat Ini</label>
                                <input type="text" class="form-control form-control-sm text-success font-weight-bold" value="<?= $anggota['nama_kelas'] ?>" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1 font-weight-bold">Umur</label>
                                <input type="text" class="form-control form-control-sm" value="<?= $anggota['umur'] ?> Tahun" readonly>
                            </div>
            
                            <div class="form-group mb-3">
                                <label class="small mb-1 font-weight-bold">Tanggal Bergabung</label>
                                <input type="text" class="form-control form-control-sm" value="<?= $anggota['tgl_daftar'] ?>" readonly>
                            </div>
                            <div class="alert alert-info py-2 px-3 mt-4 mb-0">
                                <small><i class="fas fa-info-circle mr-1"></i> Data di atas hanya dapat diubah melalui Admin Sanggar.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 border-left">
                        <div class="p-2">
                            <h6 class="font-weight-bold text-success border-bottom pb-2 mb-4">
                                <i class="fas fa-edit mr-2"></i>Perbarui Profil
                            </h6>

                            <div class="form-group text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <?php 
                                        $foto_path = base_url('admin/img/undraw_profile.svg');
                                        if (!empty($anggota['foto_profil']) && file_exists(ROOTPATH . 'public/uploads/fotoprofil/' . $anggota['foto_profil'])) {
                                            $foto_path = base_url('uploads/fotoprofil/' . $anggota['foto_profil']);
                                        }
                                    ?>
                                    <img id="previewFoto" src="<?= $foto_path ?>" 
                                         class="img-thumbnail rounded-circle shadow" 
                                         style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #1cc88a;">
                                    
                                    <label for="inputFoto" class="btn btn-sm btn-primary rounded-circle position-absolute" 
                                           style="bottom: 5px; right: 5px; cursor: pointer;" title="Ganti Foto">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                    <input type="file" name="foto_profil" id="inputFoto" class="d-none" onchange="previewImage()">
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">Klik ikon kamera untuk ganti foto (JPG/PNG, Max 1MB)</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" value="<?= old('nama', $anggota['nama']) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="laki-laki" <?= ($anggota['jenis_kelamin'] == 'laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                                            <option value="perempuan" <?= ($anggota['jenis_kelamin'] == 'perempuan') ? 'selected' : '' ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">No. WhatsApp</label>
                                        <input type="text" name="no_hp" class="form-control" value="<?= old('no_hp', $anggota['no_hp']) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="3" required><?= old('alamat', $anggota['alamat']) ?></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Pengalaman Tari</label>
                                <textarea name="pengalaman_tari" class="form-control" rows="3" placeholder="Contoh: Pernah mengikuti lomba tari tradisional tingkat sekolah..."><?= old('pengalaman_tari', $anggota['pengalaman_tari']) ?></textarea>
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-success btn-block shadow">
                                <i class="fas fa-save mr-2"></i>Simpan Perubahan Profil
                            </button>
                        </div>
                    </div>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
function previewImage() {
    const file = document.querySelector('#inputFoto').files[0];
    const preview = document.querySelector('#previewFoto');
    const reader = new FileReader();

    reader.onloadend = function() {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "<?= $foto_path ?>";
    }
}
</script>