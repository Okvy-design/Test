<?php 
// 1. Penentuan Path Foto Profil
$foto_profil_path = base_url('admin/img/undraw_profile.svg');
if (!empty($anggota['foto_profil']) && file_exists(ROOTPATH . 'public/uploads/fotoprofil/' . $anggota['foto_profil'])) {
    $foto_profil_path = base_url('uploads/fotoprofil/' . $anggota['foto_profil']);
}
?>

<div class="container-fluid">
    <div class="card border-left-success shadow h-100 py-2 mb-4">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        STATUS KEANGGOTAAN: <?= esc(strtoupper($anggota['status'] ?? 'AKTIF')) ?>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Selamat Datang, <?= esc($anggota['nama']) ?>! 👋</div>
                    <p class="mt-2 mb-0 small text-gray-600">Selamat bergabung di keluarga besar <strong>Sanggar Tari Gayatri Art</strong>. Mari melestarikan budaya bersama!</p>
                </div>
                <div class="col-auto">
                    <i class="fas fa-heart fa-2x text-gray-200"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white border-bottom-0 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-id-card mr-2"></i>Data Profil Saya</h6>
                    <a href="<?= base_url('anggota/profil/detail') ?>" class="btn btn-sm btn-success shadow-sm">
                        <i class="fas fa-eye fa-sm text-white-50"></i> Lihat Detail Profil
                    </a>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img class="img-profile rounded-circle mb-2 border shadow-sm" 
                             style="width: 120px; height: 120px; object-fit: cover;" 
                             src="<?= $foto_profil_path ?>" alt="Foto Profil">
                        <h5 class="font-weight-bold text-gray-900 mb-0"><?= esc($anggota['nama']) ?></h5>
                        <span class="badge badge-success">ID: <?= esc($anggota['id_anggota']) ?></span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td width="40%" class="text-muted small font-weight-bold">Status</td>
                                <td><span class="badge badge-info border"><?= esc($anggota['status'] ?? 'Aktif') ?></span></td>
                            </tr>
                            <tr>
                                <td width="40%" class="text-muted small font-weight-bold">Kelas</td>
                                <td><span class="badge badge-primary border"><?= esc($anggota['nama_kelas'] ?? 'Belum Ada Kelas') ?></span></td>
                            </tr>
                            <tr>
                                <td class="text-muted small font-weight-bold">Jenis Kelamin</td>
                                <td><?= esc(ucwords($anggota['jenis_kelamin'])) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted small font-weight-bold">Alamat</td>
                                <td class="small"><?= esc($anggota['alamat']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-info-circle mr-2"></i>Informasi Kontak & Pengalaman</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4 text-center">
                        <div class="col-6 border-right">
                            <div class="text-xs font-weight-bold text-gray-400 text-uppercase">No. WhatsApp</div>
                            <div class="small font-weight-bold text-gray-800"><?= esc($anggota['no_hp']) ?></div>
                        </div>
                        <div class="col-6">
                            <div class="text-xs font-weight-bold text-gray-400 text-uppercase">Bergabung Sejak</div>
                            <div class="small font-weight-bold text-gray-800"><?= date('d M Y', strtotime($anggota['tgl_daftar'])) ?></div>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <h6 class="small font-weight-bold text-dark">Pengalaman Tari:</h6>
                        <div class="small text-gray-600 bg-light p-3 rounded border-left-info" style="min-height: 100px;">
                            <?php if (!empty($anggota['pengalaman_tari'])) : ?>
                                <?= esc($anggota['pengalaman_tari']) ?>
                            <?php else : ?>
                                <span class="text-muted italic">Belum ada data pengalaman tari. Klik "Lihat Detail Profil" untuk melengkapi.</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center bg-gray-100 p-2 rounded">
                        <span class="small font-weight-bold text-gray-700">Umur Saat Ini:</span>
                        <span class="badge badge-dark"><?= esc($anggota['umur']) ?> Tahun</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>