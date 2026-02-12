<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 text-gray-800">Detail Anggota: <?= esc($anggota['nama'] ?? 'N/A') ?></h1>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Lengkap</h6>
                
                <a href="<?= base_url('admin/anggota') ?>" class="btn btn-sm btn-info shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar
                </a>
            </div>

            <div class="card-body">
    
    <div class="row">
        <div class="col-md-3 text-center mb-4">
            <div class="profile-img-container">
            <?php 
        // Cek apakah file ada dan field tidak kosong
        $pathFoto = 'uploads/fotoprofil/' . ($anggota['foto_profil'] ?? '');
        $fullPath = FCPATH . $pathFoto;
        
        if (!empty($anggota['foto_profil']) && file_exists($fullPath)): ?>
            <img src="<?= base_url($pathFoto) ?>" 
                 alt="Foto <?= esc($anggota['nama']) ?>" 
                 class="img-thumbnail rounded-circle shadow-sm"
                 style="width: 160px; height: 160px; object-fit: cover; border: 5px solid #fff;">
        <?php else: ?>
            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center shadow-sm m-auto" 
                 style="width: 160px; height: 160px; border: 5px solid #fff;">
                <i class="fas fa-user fa-5x text-gray-300"></i>
            </div>
        <?php endif; ?>
            </div>
            <div class="mt-2">
                <span class="badge badge-primary">Foto Profil Anggota</span>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">ID Anggota</dt>
                        <dd class="col-sm-8"><span class="badge badge-info"><?= esc($anggota['id_anggota'] ?? '-') ?></span></dd>

                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8 font-weight-bold text-dark"><?= esc($anggota['nama'] ?? '-') ?></dd>

                        <dt class="col-sm-4">Jenis Kelamin</dt>
                        <dd class="col-sm-8"><?= esc(ucfirst($anggota['jenis_kelamin'] ?? '-')) ?></dd>
                        
                        <dt class="col-sm-4">Kelas Tari</dt>
                        <dd class="col-sm-8"><?= esc($anggota['nama_kelas'] ?? 'Belum Ditetapkan') ?></dd>
                    </dl>
                </div>

                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">No. HP</dt>
                        <dd class="col-sm-8"><?= esc($anggota['no_hp'] ?? '-') ?></dd>

                        <dt class="col-sm-4">Tgl. Lahir / Umur</dt>
                        <dd class="col-sm-8"><?= date('d F Y', strtotime($anggota['tgl_lahir'] ?? '')) ?> (<?= esc($anggota['umur'] ?? '-') ?> thn)</dd>
                        
                        <dt class="col-sm-4">Tgl. Daftar</dt>
                        <dd class="col-sm-8"><?= date('d F Y', strtotime($anggota['tgl_daftar'] ?? '')) ?></dd>
                        
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            <?php
                                $statusClass = '';
                                $status = $anggota['status'] ?? '';
                                if ($status == 'aktif') $statusClass = 'badge-success';
                                elseif ($status == 'tidak-aktif') $statusClass = 'badge-danger';
                                elseif ($status == 'menunggu') $statusClass = 'badge-warning';
                                elseif ($status == 'keluar') $statusClass = 'badge-secondary';
                            ?>
                            <span class="badge <?= $statusClass ?>"><?= esc(ucwords(str_replace('-', ' ', $status))) ?></span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <hr class="sidebar-divider my-3">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Alamat</label>
                        <p class="border p-2 rounded"><?= nl2br(esc($anggota['alamat'] ?? '')) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Pengalaman Tari</label>
                        <p class="border p-2 rounded"><?= nl2br(esc($anggota['pengalaman_tari'] ?? '')) ?></p>
                    </div>
                </div>

                <hr class="sidebar-divider my-3">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Dokumen Pendaftaran</label>
                        <?php if (!empty($anggota['file'])): ?>
                            <a href="<?= base_url('uploads/datadiri/' . $anggota['file']) ?>" target="_blank" class="btn btn-outline-primary btn-block">
                                <i class="fas fa-file-alt"></i> Lihat Dokumen (<?= esc($anggota['file']) ?>)
                            </a>
                        <?php else: ?>
                            <p class="text-muted">Dokumen belum diunggah.</p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Bukti Transfer</label>
                        <?php if (!empty($anggota['bukti_tf'])): ?>
                            <a href="<?= base_url('uploads/transfer/' . $anggota['bukti_tf']) ?>" target="_blank" class="btn btn-outline-success btn-block">
                                <i class="fas fa-receipt"></i> Lihat Bukti Transfer (<?= esc($anggota['bukti_tf']) ?>)
                            </a>
                        <?php else: ?>
                            <p class="text-muted">Bukti transfer belum diunggah.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <hr class="sidebar-divider my-3">
                
                <div class="mt-4">
                    <a href="<?= base_url('admin/anggota/edit/'.$anggota['id_anggota']) ?>" 
                       class="btn btn-warning shadow-sm">
                        <i class="fas fa-edit"></i> Edit Data
                    </a>
                    <a href="<?= base_url('admin/anggota/delete/'.$anggota['id_anggota']) ?>" 
                       class="btn btn-danger shadow-sm ml-2" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?')">
                        <i class="fas fa-trash"></i> Hapus Anggota
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>