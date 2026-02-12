<?php 
// Asumsi: Jika data tgl_lahir sudah ada, hitung umur untuk ditampilkan
$tgl_lahir_val = $anggota['tgl_lahir'] ?? null;
$umur_otomatis = null;
if ($tgl_lahir_val) {
    // Pastikan DateTime sudah di-import atau menggunakan namespace lengkap
    $bday = new DateTime($tgl_lahir_val);
    $now = new DateTime();
    $umur_otomatis = $now->diff($bday)->y;
}

$selected_jk = strtolower(old('jenis_kelamin') ?: ($anggota['jenis_kelamin'] ?? '')); 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profil | Gayatri Art</title>
    <link href="<?= base_url('admin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('admin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('admin/img/GA.png') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-5.0.0-beta2.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/LineIcons.2.0.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" /> 
    
    <style>
        /* Mengganti body default sb-admin-2 agar full layout */
        body { 
            background-color: #f7f7f7; /* Warna latar belakang dari status-card-mode */
            display: block; /* Mengembalikan ke display block standar */
            padding-top: 80px; /* Jarak atas agar tidak tertutup header */
        }
        .form-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        fieldset {
            border: 1px solid #e3e6f0;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 6px;
        }
        legend {
            font-size: 1.25rem;
            font-weight: bold;
            color: #4e73df;
            padding: 0 10px;
            width: inherit;
            border-bottom: none;
        }
        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }
        .form-control[disabled] {
            background-color: #eaecf4;
            opacity: 1;
        }
        .file-info {
            margin-top: 5px;
            color: #5a5c69;
            font-size: 0.85rem;
        }
        /* Style untuk tombol utama di landing page */
        .main-btn {
            display: inline-block;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            padding: 12px 35px;
            font-weight: 600;
            font-size: 16px;
            line-height: 24px;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            z-index: 5;
            -webkit-transition: all 0.4s ease-in-out;
            transition: all 0.4s ease-in-out;
            overflow: hidden;
            background-color: #5a5c69; /* Warna default tombol utama */
            border: 1px solid #5a5c69;
        }
        .main-btn:hover {
            color: #fff;
            background-color: #4e73df;
            border-color: #4e73df;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="<?= base_url() ?>">
                            <img src="<?= base_url('admin/img/GA.png') ?>" alt="Logo" style="width: 65px; height: auto" /> 
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <div class="ms-auto">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="active" href="<?= base_url('anggota/dashboard') ?>">Portal Anda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="<?= base_url('logout') ?>">Logout</a>
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
<div class="container">
    <div class="form-container">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800 mb-0"><i class="fas fa-edit"></i> Lengkapi Data Pendaftaran</h1>
            <a href="<?= base_url('anggota/dashboard') ?>" class="btn btn-secondary btn-md shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Portal
            </a>
        </div>
        <p class="mb-4 text-muted">Halo, <?= $anggota['nama'] ?>. Silakan isi detail pendaftaran Anda dan unggah berkas yang diperlukan.</p>
        <?php if (session()->getFlashdata('success')): ?>
       <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> Berhasil! <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p class="mb-2">⚠️ Mohon periksa kembali input Anda:</p>
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p class="mb-2">❌ Gagal:</p>
                <p class="mb-0"><?= session()->getFlashdata('error') ?></p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('anggota/profil/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?> 

            <fieldset>
                <legend><i class="fas fa-user-edit"></i> Data Pribadi Anggota</legend>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Lengkap:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?= $anggota['nama'] ?>" disabled>
                        <small class="form-text text-muted">Nama tidak dapat diubah di sini.</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin:</label>
                    <div class="col-sm-9">
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" <?= ($selected_jk == 'laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($selected_jk == 'perempuan') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir:</label>
                    <div class="col-sm-9">
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required 
                        value="<?= old('tgl_lahir', $anggota['tgl_lahir']) ?>">
                        <?php if ($umur_otomatis): ?>
                            <small class="form-text text-success"> Perkiraan Umur saat ini: <?= $umur_otomatis ?> tahun.</small>
                        <?php else: ?>
                            <small class="form-text text-muted"> Umur akan dihitung otomatis dari Tanggal Lahir.</small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_hp" class="col-sm-3 col-form-label">Nomor HP:</label>
                    <div class="col-sm-9">
                        <input type="text" name="no_hp" id="no_hp" class="form-control" required 
                        value="<?= old('no_hp', $anggota['no_hp']) ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap:</label>
                    <div class="col-sm-9">
                        <textarea name="alamat" id="alamat" rows="3" class="form-control" required><?= old('alamat', $anggota['alamat']) ?></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><i class="fas fa-clipboard-list"></i> Detail Pendaftaran & Berkas</legend>
                
                <div class="alert alert-info small" role="alert">
                    Kelas akan ditentukan otomatis berdasarkan umur setelah Anda melengkapi data ini.
                </div>

                <div class="form-group">
                    <label for="pengalaman_tari">Pengalaman Tari (Deskripsi Singkat):</label>
                    <textarea name="pengalaman_tari" id="pengalaman_tari" rows="3" class="form-control"><?= old('pengalaman_tari', $anggota['pengalaman_tari']) ?></textarea>
                    <small class="form-text text-muted">Cukup sebutkan pernah ikut sanggar atau kursus sebelumnya (jika ada).</small>
                </div>

                <hr>
                
                <div class="form-group">
                    <label for="file">Upload Dokumen Data Diri (Akta/KK/KIA/KTP):</label>
                    <div class="custom-file">
                        <input type="file" name="file" id="file" class="custom-file-input" accept="image/jpeg,image/png">
                        <label class="custom-file-label" for="file">Pilih berkas (Max 2MB, JPG/PNG)</label>
                    </div>
                    <?php if ($anggota['file']): ?>
                        <p class="file-info text-success mt-2">
                            <i class="fas fa-file-check"></i> Berkas tersimpan: <a href="<?= base_url('uploads/datadiri/' . $anggota['file']) ?>" target="_blank">Lihat Berkas</a>. (Upload ulang untuk mengganti)
                        </p>
                    <?php else: ?>
                        <p class="file-info text-danger mt-2"><i class="fas fa-exclamation-triangle"></i> Berkas belum diunggah.</p>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
    <label for="bukti_tf">Upload Bukti Transfer Pendaftaran:</label>
    
    <div class="alert alert-light border shadow-sm small mb-3">
        <i class="fas fa-info-circle text-primary"></i> 
        Pembayaran pendaftaran dapat dilakukan melalui <strong>E-Wallet DANA</strong>.
        <br>
        <span id="dana-container">
            Nomor Tujuan: 
            <button type="button" class="btn btn-sm btn-outline-primary py-0" id="btn-show-dana" style="font-size: 11px;">
                Klik untuk melihat nomor
            </button>
            <strong id="nomor-dana" class="d-none">0819 3131 8127</strong>
        </span>
    </div>

    <div class="custom-file">
        <input type="file" name="bukti_tf" id="bukti_tf" class="custom-file-input" accept="image/jpeg,image/png">
        <label class="custom-file-label" for="bukti_tf">Pilih berkas (Max 2MB, JPG/PNG)</label>
    </div>
    
    <?php if ($anggota['bukti_tf']): ?>
        <p class="file-info text-success mt-2">
            <i class="fas fa-file-check"></i> Bukti Transfer tersimpan: <a href="<?= base_url('uploads/transfer/' . $anggota['bukti_tf']) ?>" target="_blank">Lihat Berkas</a>.
        </p>
    <?php else: ?>
        <p class="file-info text-danger mt-2"><i class="fas fa-exclamation-triangle"></i> Bukti Transfer belum diunggah.</p>
    <?php endif; ?>
</div>
                

            </fieldset>

            <fieldset>
                <legend><i class="fas fa-info-circle"></i> Status Sistem</legend>

                <p class="mb-2">Tanggal Pendaftaran Akun: <?= date('d M Y', strtotime($anggota['tgl_daftar'])) ?></p>

                <?php if ($anggota['id_anggota'] && $anggota['id_anggota'] != 'ID_UNIK_DUMMY'): ?>
                    <div class="alert alert-success mt-2">
                        <p class="mb-1">
                            ✅ ID Anggota Anda: <span class="font-weight-bold text-dark"><?= $anggota['id_anggota'] ?></span>
                        </p>
                        <p class="mb-0">Status Keanggotaan: <?= strtoupper($anggota['status']) ?></p>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning mt-2">
                        <p class="mb-1">
                            ⚠️ ID Anggota Unik: Belum dibuat.
                        </p>
                        <p class="mb-0">ID akan otomatis dibuat dan status Anda diubah menjadi 'MENUNGGU' setelah Anda menyimpan data profil ini.
                        </p>
                    </div>
                <?php endif; ?>
            </fieldset>

            <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fas fa-save"></i> Simpan Data & Lengkapi Pendaftaran
                </button>
            </div>
        </form>
        
    </div>
</div>

<script src="<?= base_url('admin/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-5.0.0-beta2.min.js') ?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>


<script>
    // Script untuk menampilkan nama file di custom file input (fitur Bootstrap)
    $('.custom-file-input').on('change', function() {
       var fileName = $(this).val().split('\\').pop();
       $(this).next('.custom-file-label').html(fileName);
    });
</script>

<script>
    $(document).ready(function() {
        // Fitur tampilkan nomor DANA
        $('#btn-show-dana').on('click', function() {
            $(this).addClass('d-none'); // Sembunyikan tombol
            $('#nomor-dana').removeClass('d-none'); // Tampilkan nomornya
        });

        // Script yang sudah ada untuk menampilkan nama file
        $('.custom-file-input').on('change', function() {
           var fileName = $(this).val().split('\\').pop();
           $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>

</body>
</html>