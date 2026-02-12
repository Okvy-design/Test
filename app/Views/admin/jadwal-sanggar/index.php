<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <p>Kelola daftar Jadwal Kelas Sanggar Gayatri Art</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('admin/jadwal-sanggar/create') ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text">Tambah Jadwal</span>
            </a>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('success') ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID Jadwal</th>
                            <th>Nama Kelas</th>
                            <th>Tipe Kelas</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Sesi</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($jadwal as $j): ?>
                        <tr>
                            <td><span class="badge badge-info"><?= esc($j['id_jadwal']) ?></span></td>
                            <td><?= esc($j['nama_kelas']) ?></td>
                            <td><?= esc($j['tipe_kelas']) ?></td>
                            <td><?= esc($j['hari']) ?></td>
                            <td><?= esc($j['waktu']) ?></td>
                            <td>
                                <?php $sesiClass = ($j['tipe_sesi'] == 'reguler') ? 'badge-success' : 'badge-warning'; ?>
                                <span class="badge <?= $sesiClass ?>"><?= esc(ucfirst($j['tipe_sesi'])) ?></span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/jadwal-sanggar/edit/'.$j['id_jadwal']) ?>" class="btn btn-warning btn-circle btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="<?= base_url('admin/jadwal-sanggar/delete/'.$j['id_jadwal']) ?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin ingin menghapus jadwal ini?')" title="Hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>