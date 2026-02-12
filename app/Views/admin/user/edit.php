<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4 col-lg-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Nama Pengguna</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/user/update/'.$user['id_user']) ?>" method="post">
                <div class="form-group">
                    <label>Username (Tidak bisa diubah)</label>
                    <input type="text" class="form-control" value="<?= $user['username'] ?>" readonly disabled>
                </div>
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Update Nama</button>
                <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>