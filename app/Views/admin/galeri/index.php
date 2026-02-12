<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success shadow-sm"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger shadow-sm"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Unggah Karya Baru</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/galeri/save') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Judul Karya</label>
                            <input type="text" name="judul" class="form-control" placeholder="Contoh: Latihan Dasar" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control" required>
                                <option value="latihan">Latihan Rutin</option>
                                <option value="lomba">Prestasi Lomba</option>
                                <option value="koreografi">Koreografi Orisinal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>File Gambar</label>
                            <input type="file" name="gambar" class="form-control-file" accept="image/*" required>
                            <small class="text-muted">Format: JPG/PNG, Max: 2MB</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-upload mr-2"></i>Simpan ke Galeri</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Koleksi Foto Web</h6>
                    <small class="text-danger">* Pastikan min. 3 foto per kategori</small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover border">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th> 
                                    <th>Pratinjau</th> 
                                    <th>Detail</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($galeri as $g): ?>
                                <tr>
                                    <td>
                                        <span class="badge badge-dark"><?= $g['id_galeri'] ?></span></td> 
                                    <td align="center">
                                            <img src="<?= base_url('assets/images/galeri/' . $g['gambar']) ?>" style="width: 80px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong class="text-dark"><?= $g['judul'] ?></strong><br>
                                        <span class="badge badge-pill badge-secondary"><?= ucfirst($g['kategori']) ?></span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $g['id_galeri'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url('admin/galeri/delete/' . $g['id_galeri']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus foto ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editModal<?= $g['id_galeri'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?= base_url('admin/galeri/update') ?>" method="post">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id_galeri" value="<?= $g['id_galeri'] ?>">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Info Foto</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Judul</label>
                                                        <input type="text" name="judul" class="form-control" value="<?= $g['judul'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kategori</label>
                                                        <select name="kategori" class="form-control">
                                                            <option value="latihan" <?= $g['kategori'] == 'latihan' ? 'selected' : '' ?>>Latihan</option>
                                                            <option value="lomba" <?= $g['kategori'] == 'lomba' ? 'selected' : '' ?>>Lomba</option>
                                                            <option value="koreografi" <?= $g['kategori'] == 'koreografi' ? 'selected' : '' ?>>Koreografi</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" rows="3"><?= $g['deskripsi'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>