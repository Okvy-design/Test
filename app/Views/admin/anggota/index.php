<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
   <p>Daftar Anggota Sanggar Tari Gayatri Art Kota Pekalongan</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <a href="<?= base_url('admin/anggota/create') ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text">Tambah Anggota</span>
            </a>
            </div>

        <div class="card-body">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>ID Anggota</th> 
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th> <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Umur</th>
                            <th>No HP</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; 
                        if (isset($anggota) && is_array($anggota)):
                            foreach($anggota as $a): 
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><span class="badge badge-info"><?= esc($a['id_anggota']) ?></span></td> 
                            <td><?= esc($a['nama']) ?></td>
                            <td><?= esc($a['jenis_kelamin']) ?></td>
                            <td><?= esc($a['nama_kelas'] ?? '-') ?></td> 
                            <td><?= esc($a['alamat']) ?></td>
                            <td><?= date('d F Y', strtotime($a['tgl_lahir'])) ?></td>
                            <td><?= esc($a['umur']) ?></td>
                            <td><?= esc($a['no_hp']) ?></td>
                            <td><?= date('d F Y', strtotime($a['tgl_daftar'])) ?></td>
                            <td>
                                <?php
                                    $statusClass = '';
                                    // Status yang memungkinkan: aktif, tidak-aktif, menunggu, keluar
                                    if ($a['status'] == 'aktif') $statusClass = 'badge-success';
                                    elseif ($a['status'] == 'tidak-aktif') $statusClass = 'badge-danger';
                                    elseif ($a['status'] == 'menunggu') $statusClass = 'badge-warning';
                                    elseif ($a['status'] == 'keluar') $statusClass = 'badge-secondary';
                                    else $statusClass = 'badge-light'; // default
                                ?>
                                <span class="badge <?= $statusClass ?>"><?= esc(ucwords(str_replace('-', ' ', $a['status']))) ?></span>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/anggota/detail/'.$a['id_anggota']) ?>" 
                                   class="btn btn-info btn-circle btn-sm" title="Detail Anggota">
                                    <i class="fas fa-eye"></i> </a>
                            </td>
                        </tr>
                        <?php endforeach; 
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>