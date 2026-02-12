<?php 
// Variabel data (pastikan ini dipassing dari Controller)
$status = $anggota['status'] ?? 'tidak-aktif'; 
$nama_kelas = $anggota['nama_kelas'] ?? 'Belum Ditentukan'; 
$admin_wa_link = 'https://wa.me/628193131862127?text=Halo%20Admin%20Sanggar%20Gayatri%20Art%2C%20saya%20anggota%20dengan%20nama%20%5BNama%20Anda%5D%20dengan%20ID%20%5BID%20Anggota%20Anda%5D%20ingin%20mengaktifkan%20kembali%20status%20keanggotaan%20saya%20yang%20berstatus%20KELUAR.';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anggota | Sanggar Gayatri Art</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('admin/img/GA.png') ?>" />
    <link rel="icon" type="image/png" href="<?= base_url('admin/img/GA.png') ?>" />
    <link rel="apple-touch-icon" href="<?= base_url('admin/img/GA.png') ?>" />

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-5.0.0-beta2.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/LineIcons.2.0.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />
    
    <style>
        .status-card-mode { background-color: #f7f7f7; font-family: 'Arial', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .status-container { max-width: 600px; width: 90%; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); text-align: center; }
        .icon { font-size: 3rem; margin-bottom: 20px; }
        .btn-custom { margin-top: 20px; font-weight: bold; border-radius: 5px; }
        .alert-custom { padding: 25px; border-radius: 8px; margin-top: 20px;}
        .profile-card { background-color: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
    </style>
</head>

<?php if ($status == 'menunggu' || $status == 'tidak-aktif' || $status == 'keluar'): ?>

<body style="background-color: #f7f7f7;">
    <header class="header">
        <div class="navbar-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="#">
                                <img src="<?= base_url('admin/img/GA.png') ?>" alt="Logo" style="width: 65px; height: auto" /> 
                            </a>
                            <div class="collapse navbar-collapse">
                                <div class="ms-auto">
                                    <ul id="nav" class="navbar-nav ms-auto">
                                        <li class="nav-item">
                                            <a class="active" href="<?= base_url('anggota/dashboard') ?>">Portal Anda</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url('logout') ?>">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="profil" class="about-section pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <?php if ($status == 'menunggu'): ?>
                    <div class="alert alert-info p-4 mb-5 shadow-sm" style="background-color: #e2f2ff; border-left: 5px solid #0d6efd;">
                        <h4 class="alert-heading text-primary"><i class="fas fa-hourglass-half me-2"></i> Menunggu Verifikasi Admin</h4>
                        <hr>
                        <p>Halo, <?= esc($anggota['nama'] ?? 'Anggota') ?>.</p>
                        <p>Data profil dan berkas Anda sedang diperiksa oleh Admin. Proses verifikasi biasanya memakan waktu 1x24 jam.</p>
                        <div class="alert alert-warning p-2 small mt-3">
                            <i class="fas fa-users me-1"></i> Belum Masuk Grup Resmi Sanggar? <a href="<?= base_url('anggota/profil/sukses') ?>" target="_blank" class="alert-link fw-bold">Gabung di Sini</a>.
                        </div>
                    </div>

                    <div class="profile-card">
                        <div class="section-title text-center">
                            <h2 class="mb-20">Data Profil Keanggotaan</h2>
                            <p class="text-muted mb-4">Data ini sedang diverifikasi dan tidak dapat diubah.</p>
                        </div>
                        <?php echo view('anggota/profil_lihat', ['anggota_data' => $anggota]); ?>
                        </div>

                    <?php elseif ($status == 'tidak-aktif'): ?>
                    <div class="alert alert-warning p-4 mb-5 shadow-sm" style="background-color: #fffbe6; border-left: 5px solid #ffc107;">
                        <h4 class="alert-heading text-warning"><i class="fas fa-exclamation-triangle me-2"></i> Tindakan Diperlukan: Status Belum Aktif</h4>
                        <hr>
                        <p>Silakan lengkapi data profil dan berkas untuk mengaktifkan status Anda.</p>
                        <a href="<?= base_url('anggota/profil/edit') ?>" class="btn btn-warning btn-lg btn-custom shadow">
                            <i class="fas fa-edit"></i> Lengkapi Profil Sekarang
                        </a>
                    </div>

                    <?php elseif ($status == 'keluar'): ?>
                    <div class="alert alert-danger p-4 mb-5 shadow-sm" style="background-color: #fce7e7; border-left: 5px solid #e74a3b;">
                        <h4 class="alert-heading text-danger"><i class="fas fa-user-slash me-2"></i> Status Keanggotaan: KELUAR</h4>
                        <hr>
                        <p>Anda tidak memiliki akses ke portal. Hubungi Admin untuk aktivasi kembali.</p>
                        <a href="<?= $admin_wa_link ?>" target="_blank" class="btn btn-danger btn-lg btn-custom shadow">
                            <i class="fab fa-whatsapp"></i> Hubungi Admin
                        </a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
</body>

<?php else: // Status AKTIF ?>
<body class="status-card-mode">
    <div class="status-container bg-white">
        <h2 class="mb-4">Halo, <?= esc($anggota['nama'] ?? 'Anggota') ?></h2>
        <div class="alert-custom alert-success">
            <div class="icon text-success">✅</div>
            <h3 class="text-success">Status Keanggotaan: AKTIF</h3>
            <p>Anda akan segera masuk ke portal utama...</p>
            <a href="<?= base_url('anggota/index') ?>" class="btn btn-success btn-lg btn-custom shadow mt-3">
                <i class="fas fa-arrow-right"></i> Masuk Ke Portal Utama
            </a>
        </div>
        <div class="separator-link mt-4">
            <a href="<?= base_url('logout') ?>" class="text-danger">Logout dari Akun</a>
        </div>
    </div>
</body>
<?php endif; ?>
</html>