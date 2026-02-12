<!DOCTYPE html>
<html class="no-js" lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Galeri Karya | Sanggar Gayatri Art</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('admin/img/GA.png') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-5.0.0-beta2.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/LineIcons.2.0.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />

    <style>
        .gallery-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden; /* Penting untuk gambar */
            height: 100%;
            transition: transform 0.3s ease;
        }
        .gallery-card:hover {
            transform: translateY(-5px);
        }
        .gallery-card img {
            width: 100%;
            height: 220px; /* Tinggi tetap untuk thumbnail */
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .gallery-card:hover img {
            transform: scale(1.05);
        }
        .card-content {
            padding: 15px;
        }
        .card-content h5 {
            font-weight: 600;
            color: #333;
        }
        .gallery-section {
            padding: 80px 0;
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
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <div class="ms-auto">
                                    <ul id="nav" class="navbar-nav ms-auto">
                                        <li class="nav-item"><a class="" href="<?= base_url() ?>">Beranda</a></li>
                                        <li class="nav-item"><a class="active" href="<?= base_url('galeri') ?>">Galeri</a></li>
                                    </ul>
                                </div>
                               
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="page-title-area text-center pt-120 pb-50" style="background-color: #f0f7ff;">
        <div class="container">
            <h1 class="mb-3">Dokumentasi Karya Sanggar Gayatri Art</h1>
            <p class="lead">Jelajahi hasil latihan, prestasi lomba, dan koreografi orisinal kami.</p>
        </div>
    </div>
    
    <section id="latihan" class="gallery-section">
    <div class="container">
        <div class="row">
            <?php foreach ($latihan as $item) : ?>
                
                <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp">
                    <div class="gallery-card">
                        <img src="<?= base_url('assets/images/galeri/' . $item['gambar']) ?>" alt="<?= $item['judul'] ?>">
                        <div class="card-content">
                            <h5><?= $item['judul'] ?></h5>
                            <p class="text-muted"><?= $item['deskripsi'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
    
<section id="lomba" class="gallery-section" style="background-color: #f7f7f7;">
    <div class="container">
        <div class="row">
            <?php foreach ($lomba as $item) : ?>
                <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp">
                    <div class="gallery-card">
                        <img src="<?= base_url('assets/images/galeri/' . $item['gambar']) ?>" alt="<?= $item['judul'] ?>">
                        <div class="card-content">
                            <h5><?= $item['judul'] ?></h5>
                            <p class="text-muted"><?= $item['deskripsi'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

    <section id="koreografi" class="gallery-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4 text-warning">Koreografi Orisinal (Video)</h2>
                    <p class="mb-5">Kumpulan karya tari lengkap yang dapat Anda saksikan melalui kanal YouTube resmi kami.</p>
                    
                    <a href="https://youtube.com/@gaya3art?si=ju_YyiEz4h2VbSb-" target="_blank" class="main-btn btn-hover mb-5">
                        <i class="lni lni-youtube me-2"></i> Kunjungi Channel YouTube Kami
                    </a>
                </div>
            </div>

           
            </div>
        </div>
    </section>

    <a href="#" class="scroll-top btn-hover">
        <i class="lni lni-chevron-up"></i>
    </a>
    <script src="<?= base_url('assets/js/bootstrap-5.0.0-beta2.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>

</html>