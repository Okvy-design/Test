<?php 
// Variabel data $anggota_data sudah dipassing dari Dashboard.php
$anggota_data = $anggota_data ?? []; 
?>

<div class="row pt-4">
    <div class="col-md-6 mb-4">
        <h4 class="mb-3 text-primary"><i class="fas fa-user-circle me-2"></i> Data Pribadi</h4>
        <div class="mb-3">
            <div class="profile-label">Nama Lengkap:</div>
            <div class="profile-value"><?= esc($anggota_data['nama'] ?? '-') ?></div>
        </div>
        <div class="mb-3">
            <div class="profile-label">Jenis Kelamin:</div>
            <div class="profile-value"><?= esc($anggota_data['jenis_kelamin'] ?? '-') ?></div>
        </div>
        <div class="mb-3">
            <div class="profile-label">Tanggal Lahir:</div>
            <div class="profile-value"><?= esc($anggota_data['tgl_lahir'] ?? '-') ?></div>
        </div>
        <div class="mb-3">
            <div class="profile-label">Umur:</div>
            <div class="profile-value"><?= esc($anggota_data['umur'] ?? '-') ?></div>
        </div>
        <div class="mb-3">
            <div class="profile-label">Nomor HP:</div>
            <div class="profile-value"><?= esc($anggota_data['no_hp'] ?? '-') ?></div>
        </div>
        <div class="mb-3">
            <div class="profile-label">Alamat Lengkap:</div>
            <div class="profile-value"><?= esc($anggota_data['alamat'] ?? '-') ?></div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <h4 class="mb-3 text-success"><i class="fas fa-clipboard-list me-2"></i> Detail Pendaftaran</h4>
        <div class="mb-3">
            <div class="profile-label">Kelas Saat Ini:</div>
            <div class="profile-value text-uppercase fw-bold text-success"><?= esc($anggota_data['nama_kelas'] ?? 'BELUM DITENTUKAN') ?></div>
        </div>
        <div class="mb-3">
            <div class="profile-label">Pengalaman Tari:</div>
            <div class="profile-value"><?= esc($anggota_data['pengalaman_tari'] ?? '-') ?></div>
        </div>
        <div class="mb-3">
            <div class="profile-label">Dokumen Pendaftaran:</div>
            <?php if (!empty($anggota_data['file'])): ?>
                <div class="profile-value"><a href="<?= base_url('uploads/datadir/' . $anggota_data['file']) ?>" target="_blank" class="text-success">Lihat Berkas (KK/KTP/Akta)</a></div>
            <?php else: ?>
                <div class="profile-value text-danger">Berkas belum diunggah.</div>
            <?php endif; ?>
        </div>
        
        <h4 class="mb-3 mt-4 text-warning"><i class="fas fa-hourglass-half me-2"></i> Status Keanggotaan</h4>
        <div class="mb-3">
            <div class="profile-label">Status Saat Ini:</div>
            <div class="profile-value text-uppercase fw-bold text-warning"><?= esc($anggota_data['status'] ?? 'Tidak Diketahui') ?></div>
        </div>
        <div class="mb-3">
            <div class="profile-label">Tanggal Pendaftaran:</div>
            <div class="profile-value"><?= esc($anggota_data['tgl_daftar'] ?? '-') ?></div>
        </div>
    </div>
</div>