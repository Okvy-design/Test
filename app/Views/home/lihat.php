<!DOCTYPE html>
<html class="no-js" lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?= esc($title ?? 'Informasi Sanggar | Sanggar Gayatri Art') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link rel="shortcut icon" type="image/x-icon" href="../../admin/img/GA.png" />
    <link rel="stylesheet" href="../../assets/css/bootstrap-5.0.0-beta2.min.css" />
    <link rel="stylesheet" href="../../assets/css/LineIcons.2.0.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="../../assets/css/animate.css" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
    
    <style>
        /* CSS Tambahan untuk Card Pendaftaran */
        .single-feature {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .single-feature:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .feature-icon i {
            font-size: 1.8rem;
            min-width: 40px; 
        }
        .feature-content h4 {
            font-weight: 600;
        }
        .feature-content p {
            font-size: 0.95rem;
        }
        /* Style untuk tombol disable */
        .main-btn[disabled] {
            cursor: not-allowed;
            opacity: 0.6;
            transform: scale(1); /* Mencegah efek hover pada disabled */
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
                                <img src="../../admin/img/GA.png" alt="Logo" style="width: 65px; height: auto" /> 
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
                                            <a class="" href="<?= base_url() ?>">Beranda</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="active" href="<?= base_url('home/lihat') ?>">Lihat Informasi</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="header-btn">
                                    <?php if (isset($pendaftaran_dibuka) && $pendaftaran_dibuka): ?>
                                        <a href="<?= base_url('register') ?>" class="main-btn btn-hover">Daftar Sekarang</a>
                                    <?php else: ?>
                                        <button class="main-btn" disabled style="opacity: 0.7; background-color: #f79991;">Pendaftaran Ditutup</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <section id="info" class="about-section pt-120 pb-80">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-lg-6 order-last order-lg-first">
                    <div class="about-image">
                        <img src="../../assets/images/cta/cta-image.svg" alt="Visualisasi"> 
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="about-content-wrapper">
                        <div class="section-title">
                            <h2 class="mb-20">
                                <?= esc($info_pendaftaran['judul'] ?? 'Wujudkan Bakat Seni Anda Bersama Sanggar Gayatri Art') ?>
                            </h2>
                            
                            <p class="mb-30">
                                <?= esc($info_pendaftaran['deskripsi'] ?? 'Sanggar Gayatri Art bukan sekadar tempat berlatih, tetapi rumah bagi para seniman muda Pekalongan...') ?>
                            </p>
                            
                            <h4 class="mb-3">Langkah Mudah Bergabung:</h4>
                            <ol class="list-unstyled mb-4">
                                <?php 
                                // Ambil langkah-langkah, default jika data kosong
                                $langkah_default = "1. Klik tombol di bawah ini.\n2. Isi data diri calon anggota secara lengkap.\n3. Kirim formulir dan tunggu informasi dari tim kami.";
                                $langkah = explode("\n", $info_pendaftaran['langkah_gabung'] ?? $langkah_default);
                                foreach ($langkah as $l):
                                ?>
                                    <li><i class="lni lni-check-mark-circle text-success me-2"></i> <?= esc(trim($l)) ?></li>
                                <?php endforeach; ?>
                            </ol>
                            
                            <?php if (isset($pendaftaran_dibuka) && $pendaftaran_dibuka): ?>
                                <a href="<?= base_url('register') ?>" class="main-btn btn-hover">Gabung Sekarang &gt;&gt;</a>
                            <?php else: ?>
                                <button class="main-btn" disabled>Pendaftaran Ditutup</button>
                                <p class="mt-2 text-danger">Periode pendaftaran saat ini telah berakhir atau belum dimulai.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="pendaftaran-info" class="feature-section pt-40 pb-120" style="background-color: #fff;">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4">Informasi Jadwal Pendaftaran</h2>
                    <p class="text-muted">Jadwal pendaftaran terbaru Sanggar Gayatri Art untuk program reguler.</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <?php if (isset($info_pendaftaran) && $info_pendaftaran): ?>
                    <div class="col-lg-10 mb-4">
                        <div class="single-feature d-block text-center" style="border: 2px solid <?= $pendaftaran_dibuka ? '#4e73df' : '#e74a3b' ?>;">
                            <div class="feature-icon mb-3">
                                <i class="lni lni-calendar text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                            <div class="feature-content">
                                <h4><?= esc($info_pendaftaran['periode_pendaftaran']) ?></h4>
                                <p class="text-muted">
                                    Mulai: **<?= date('d F Y', strtotime($info_pendaftaran['tgl_mulai_daftar'])) ?>**
                                    &mdash;
                                    Berakhir: **<?= date('d F Y', strtotime($info_pendaftaran['tgl_akhir_daftar'])) ?>**
                                </p>
                                <?php if ($pendaftaran_dibuka): ?>
                                    <span class="badge bg-success py-2 px-3 fw-bold">PENDAFTARAN DIBUKA</span>
                                <?php else: ?>
                                    <span class="badge bg-danger py-2 px-3 fw-bold">PENDAFTARAN DITUTUP</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-lg-10 text-center">
                        <p class="alert alert-info">Belum ada informasi jadwal pendaftaran yang aktif saat ini. Silakan hubungi admin.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <section id="biaya-jadwal" class="about-section pt-80 pb-120" style="background-color: #f0f7ff;">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4">Rincian Biaya dan Jadwal Kelas Reguler</h2>
                    <p class="text-muted">Semua informasi biaya dan jadwal latihan kelas reguler kami.</p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-7 mb-4">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h3 class="mb-3 text-primary">Jadwal Latihan Reguler (2x Seminggu)</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Kelas</th>
                                        <th>Hari</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (isset($jadwal_reguler) && !empty($jadwal_reguler)): 
                                        $grouped_jadwal = [];
                                        foreach ($jadwal_reguler as $j) {
                                            $tipe = strtoupper(isset($j['tipe_kelas']) ? $j['tipe_kelas'] : 'LAIN'); 
                                            if (!isset($grouped_jadwal[$tipe])) {
                                                $grouped_jadwal[$tipe] = [];
                                            }
                                            $grouped_jadwal[$tipe][] = $j;
                                        }

                                        foreach ($grouped_jadwal as $tipe => $list_jadwal): 
                                    ?>
                                            <tr>
                                                <td class="fw-bold bg-light" colspan="3">KELAS <?= esc($tipe) ?></td>
                                            </tr>
                                            <?php foreach ($list_jadwal as $j): ?>
                                                <tr>
                                                    <td><?= esc($j['nama_kelas'] ?? 'Nama Kelas Kosong') ?></td>
                                                    <td><?= esc($j['hari'] ?? '-') ?></td>
                                                    <td><?= esc($j['waktu'] ?? '-') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3">Belum ada jadwal latihan Reguler yang tersedia.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mb-4">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h3 class="mb-3 text-success">Rincian Biaya</h3>
                        <?php 
                            $biaya_pendaftaran = 'Rp -';
                            $biaya_iuran = 'Rp -';
                            
                            if (isset($biaya) && is_array($biaya)) {
                                foreach ($biaya as $b) {
                                    $jumlah_format = 'Rp ' . number_format($b['jumlah'] ?? 0, 0, ',', '.');
                                    
                                    if (strpos(strtolower($b['jenis_biaya'] ?? ''), 'pendaftaran') !== false) {
                                        $biaya_pendaftaran = $jumlah_format;
                                    }
                                    if (strpos(strtolower($b['jenis_biaya'] ?? ''), 'iuran bulanan') !== false) {
                                        $biaya_iuran = $jumlah_format;
                                    }
                                }
                            }
                        ?>
                        <ul class="list-unstyled">
                            <li class="h5 mb-3">Biaya Pendaftaran: <span class="text-danger fw-bold"><?= $biaya_pendaftaran ?></span> (Dibayarkan sekali di awal)</li>
                            <li class="h5 mb-4">Biaya Iuran Bulanan: <span class="text-danger fw-bold"><?= $biaya_iuran ?></span></li>
                        </ul>
                        
                        <hr>
                        
                        <h4 class="mb-3">Kelas Private (Eksklusif)</h4>
                        <p class="text-muted">Untuk pelatihan yang lebih intensif, personal, atau kebutuhan khusus event, kami menyediakan kelas private.</p>
                        <a href="https://wa.me/6281931318127?text=Halo%20Admin%20Sanggar%20Gayatri%20Art,%20saya%20tertarik%20dengan%20Kelas%20Private." 
                            target="_blank" 
                            class="main-btn btn-hover">
                            <i class="lni lni-whatsapp me-2"></i> Konsultasi Kelas Private
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <a href="#" class="scroll-top btn-hover">
        <i class="lni lni-chevron-up"></i>
    </a>

    <script src="../../assets/js/bootstrap-5.0.0-beta2.min.js"></script>
    <script src="../../assets/js/main.js"></script>
</body>

</html>