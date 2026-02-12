<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-edit me-2"></i> <?= $title ?></h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-left-success" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger border-left-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger border-left-danger">
            <h6>Mohon koreksi kesalahan berikut:</h6>
            <ul class="mb-0">
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-success">Perbarui Data yang Diizinkan</h6>
            <p class="text-muted small mb-0 mt-1">Hanya Nama, No HP, Alamat, Pengalaman Tari, dan Foto Profil yang dapat diubah.</p>
        </div>
        <div class="card-body">
            <form action="<?= base_url('anggota/profil/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control <?= (isset($validation) && $validation->hasError('nama')) ? 'is-invalid' : '' ?>" 
                                value="<?= old('nama') ?? esc($anggota['nama']) ?>" required>
                            <?php if(isset($validation) && $validation->hasError('nama')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('nama') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="no_hp">Nomor Telepon (HP)</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control <?= (isset($validation) && $validation->hasError('no_hp')) ? 'is-invalid' : '' ?>" 
                                value="<?= old('no_hp') ?? esc($anggota['no_hp']) ?>" required>
                            <?php if(isset($validation) && $validation->hasError('no_hp')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('no_hp') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="foto_profil">Foto Profil (JPG/PNG Max 2MB)</label>
                            <input type="file" name="foto_profil" id="foto_profil" class="form-control-file <?= (isset($validation) && $validation->hasError('foto_profil')) ? 'is-invalid' : '' ?>">
                            <?php if (!empty($anggota['foto_profil'])): ?>
                                <small class="text-info d-block mt-1">File saat ini: <strong><?= esc($anggota['foto_profil']) ?></strong></small>
                            <?php endif; ?>
                            <?php if(isset($validation) && $validation->hasError('foto_profil')): ?>
                                <div class="text-danger small mt-1"><?= $validation->getError('foto_profil') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold" for="alamat">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" class="form-control <?= (isset($validation) && $validation->hasError('alamat')) ? 'is-invalid' : '' ?>" rows="3" required><?= old('alamat') ?? esc($anggota['alamat']) ?></textarea>
                    <?php if(isset($validation) && $validation->hasError('alamat')): ?>
                        <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold" for="pengalaman_tari">Pengalaman Tari/Seni (Opsional)</label>
                    <textarea name="pengalaman_tari" id="pengalaman_tari" class="form-control <?= (isset($validation) && $validation->hasError('pengalaman_tari')) ? 'is-invalid' : '' ?>" rows="3"><?= old('pengalaman_tari') ?? esc($anggota['pengalaman_tari']) ?></textarea>
                    <?php if(isset($validation) && $validation->hasError('pengalaman_tari')): ?>
                        <div class="invalid-feedback"><?= $validation->getError('pengalaman_tari') ?></div>
                    <?php endif; ?>
                </div>

                <div class="alert alert-light border mt-4">
                    <small class="text-muted">
                        <i class="fas fa-info-circle mr-1"></i> Untuk mengubah data sensitif (Tanggal Lahir, Berkas Identitas, dll), harap hubungi Admin.
                    </small>
                </div>
                
                <hr>
                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-success mr-2">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('anggota/profil') ?>" class="btn btn-secondary">
                        <i class="fas fa-times mr-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>