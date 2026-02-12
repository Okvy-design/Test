<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow mb-4 border-left-success">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-lock mr-2"></i>Keamanan Akun</h6>
                </div>
                <div class="card-body">

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('anggota/update-password') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="form-group">
                            <label class="text-dark">Password Saat Ini</label>
                            <input type="password" name="password_lama" class="form-control" placeholder="******" required>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="text-dark">Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" placeholder="Minimal 8 karakter" required>
                        </div>

                        <div class="form-group">
                            <label class="text-dark">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi_password" class="form-control" placeholder="Ulangi password baru" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block shadow-sm">
                            <i class="fas fa-save mr-1"></i> Perbarui Kata Sandi
                        </button>
                        <a href="<?= base_url('anggota/profil') ?>" class="btn btn-light btn-block mt-2">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>