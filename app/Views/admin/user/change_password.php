<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ganti Password Admin</h6>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/user/update-password') ?>" method="post">
                        <div class="form-group">
                            <label>Password Lama</label>
                            <div class="input-group">
                                <input type="password" name="password_lama" class="form-control pass-input" placeholder="Masukkan password saat ini" required>
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" style="cursor: pointer;"><i class="fas fa-eye"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Password Baru</label>
                            <div class="input-group">
                                <input type="password" name="password_baru" class="form-control pass-input" placeholder="Masukkan password baru" required>
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" style="cursor: pointer;"><i class="fas fa-eye"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" name="konfirmasi_password" class="form-control pass-input" placeholder="Ulangi password baru" required>
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" style="cursor: pointer;"><i class="fas fa-eye"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-block mb-2">Simpan Password Baru</button>
                            <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary btn-block">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(".toggle-password").click(function() {
        $(this).toggleClass("active");
        var input = $(this).closest('.input-group').find('.pass-input');
        if (input.attr("type") == "password") {
            input.attr("type", "text");
            $(this).find('i').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            input.attr("type", "password");
            $(this).find('i').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
});
</script>
<?= $this->endSection() ?>