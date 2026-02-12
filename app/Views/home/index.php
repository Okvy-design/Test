<!DOCTYPE html>
<html class="no-js" lang="">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<title>Portal Pendaftaran | Sanggar Gayatri Art</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" type="image/x-icon" href="admin/img/GA.png" />
	<!-- Place favicon.ico in the root directory -->

	<!-- ========================= CSS here ========================= -->
	<link rel="stylesheet" href="assets/css/bootstrap-5.0.0-beta2.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
	<link rel="stylesheet" href="assets/css/LineIcons.2.0.css" />
	<link rel="stylesheet" href="assets/css/tiny-slider.css" />
	<link rel="stylesheet" href="assets/css/animate.css" />
	<link rel="stylesheet" href="assets/css/main.css" />
    <style>
@media only screen and (max-width: 991px) {
    .header-btn {
        display: block !important;
        position: absolute;
        right: 70px; 
        top: 25px;
        z-index: 99;
    }
    .header-btn .main-btn {
        padding: 8px 20px !important;
        font-size: 14px !important;
    }
}
</style>
</head>

<body>
	<!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

	<!-- ========================= preloader start ========================= -->
	<div class="preloader">
		<div class="loader">
			<div class="spinner">
				<div class="spinner-container">
					<div class="spinner-rotator">
						<div class="spinner-left">
							<div class="spinner-circle"></div>
						</div>
						<div class="spinner-right">
							<div class="spinner-circle"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- preloader end -->


	<!-- ========================= header start ========================= -->
	<header class="header">
		<div class="navbar-area">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.html">
                                <img src="admin/img/GA.png" alt="Logo" style="width: 65px; height: auto" />
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
                                        <li class="nav-item"><a class="page-scroll active" href="#home">Beranda</a></li>
                                        <li class="nav-item"><a class="page-scroll" href="#about">Tentang</a></li>
                                        <li class="nav-item"><a class="page-scroll" href="#harga">Harga</a></li>
                                        <li class="nav-item"><a class="page-scroll" href="#karya">Karya</a></li>
                                        
                                        <li class="nav-item d-lg-none">
                                            <?php if (isset($is_logged_in) && $is_logged_in): ?>
                                                <a href="<?= base_url('anggota/profil') ?>" class="main-btn btn-hover btn-primary w-100 text-center mt-3">Portal Anda</a>
                                            <?php else: ?>
                                                <a href="<?= base_url('login') ?>" class="main-btn btn-hover btn-success w-100 text-center mt-3">Login</a>
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="header-btn d-none d-lg-block">
                                <?php if (isset($is_logged_in) && $is_logged_in): ?>
                                    <a href="<?= base_url('anggota/profil') ?>" class="main-btn btn-hover btn-primary">Portal Anda</a>
                                <?php else: ?>
                                    <a href="<?= base_url('login') ?>" class="main-btn btn-hover btn-success">Login</a>
                                <?php endif; ?>
                            </div>
                        </nav>
						<!-- navbar -->
					</div>
				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</div>
		<!-- navbar area -->
	</header>
	<!-- ========================= header end ========================= -->

	<!-- ========================= hero-section start ========================= -->
	<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-10">
                <div class="hero-content">
                    <h1>Portal Pendaftaran Online Sanggar Gayatri Art Kota Pekalongan</h1>
                    <p>Kami melayani proses pendaftaran online bagi calon anggota yang ingin bergabung. Pendaftaran
                        anggota lebih mudah dan praktis.
                    </p>

                    <?php if (!isset($is_logged_in) || !$is_logged_in): ?>
                        <a href="<?= base_url('home/lihat') ?>" class="main-btn btn-hover border-btn">
                            Lihat Selengkapnya
                            <i class="lni lni-arrow-right-circle ms-2"></i>
                        </a>
                    <?php endif; ?>
                    </div>
            </div>
				<div class="col-xxl-6 col-xl-6 col-lg-6">
				<div class="hero-image text-center text-lg-end">
					<div class="diamond-gallery">
						<div class="image-item item-1"><img src="assets/images/hero/photo-5.jpg" alt="Foto 1"></div>
						<div class="image-item item-2"><img src="assets/images/hero/photo-2.jpg" alt="Foto 2"></div>
						<div class="image-item item-3"><img src="assets/images/hero/photo-4.jpg" alt="Foto 4"></div>
						
					</div>
					</div>
			</div>
			</div>
		</div>
	</section>
	<!-- ========================= hero-section end ========================= -->

	<!-- ========================= about-section start ========================= -->
	<section id="about" class="about-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 order-last order-lg-first">
                <div class="about-image">
                    <img src="assets/images/about/about-image.svg" alt="Ilustrasi Asli">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content-wrapper">
                    <div class="section-title">
                        <h2 class="mb-20">Dirancang untuk mendukung proses operasional sanggar</h2>
                        <p class="mb-30">Platform ini dibuat untuk menyederhanakan dan mempermudah proses 
                            operasional sanggar, terutama dalam penerimaan anggota baru. Dengan akses yang mudah, 
                            sistem ini membantu calon anggota dan orangtua/wali dalam melakukan pendaftaran, sekaligus menunjukkan komitmen 
                            sanggar dalam memanfaatkan teknologi demi kemudahan akses.</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="about" class="about-section pt-120 pb-120" style="background-color: #f0f7ff;"> 
    <div class="container">
        
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 text-center">
                <div class="section-title">
                    <h2 class="mb-20 wow fadeInUp" data-wow-delay=".4s">
                        Manfaat dan Keuntungan menggunakan Website Sistem Pendaftaran Sanggar
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h3 class="mb-4 text-primary">Bagi Calon Anggota dan Wali</h3>
                
                <div class="single-benefit d-flex align-items-start mb-4 wow fadeInUp" data-wow-delay=".2s">
                    <i class="lni lni-mobile me-3 fs-3 text-warning"></i>
                    <div>
                        <h4 class="h5 mb-1">Pendaftaran 24/7</h4>
                        <p class="text-muted">Proses pendaftaran yang sepenuhnya online memungkinkan akses tanpa batasan waktu dan lokasi.</p>
                    </div>
                </div>
                
                <div class="single-benefit d-flex align-items-start mb-4 wow fadeInUp" data-wow-delay=".3s">
                    <i class="lni lni-agenda me-3 fs-3 text-warning"></i>
                    <div>
                        <h4 class="h5 mb-1">Informasi Komprehensif</h4>
                        <p class="text-muted">Semua informasi biaya, dan jadwal disajikan secara transparan di satu tempat, mengurangi kebutuhan komunikasi bolak-balik.</p>
                    </div>
                </div>
                
                <div class="single-benefit d-flex align-items-start mb-4 wow fadeInUp" data-wow-delay=".4s">
                    <i class="lni lni-whatsapp me-3 fs-3 text-warning"></i>
                    <div>
                        <h4 class="h5 mb-1">Akses Grup Resmi</h4>
                        <p class="text-muted">Setelah pengisian formulir, kamu dapat bergabung ke dalam grup whatsapp resmi sanggar gayatri art untuk akses informasi lebih lanjut.</p>
                    </div>
                </div>
                
                <div class="single-benefit d-flex align-items-start mb-4 wow fadeInUp" data-wow-delay=".5s">
                    <i class="lni lni-save me-3 fs-3 text-warning"></i>
                    <div>
                    <h4 class="h5 mb-1">Keamanan Data Terjamin</h4>
                    <p class="text-muted">Data pribadi diolah dan disimpan dengan standar keamanan modern, memberikan rasa tenang bagi orangtua/wali.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <h3 class="mb-4 text-success">Bagi Pihak Sanggar (Manajemen)</h3>
                
                <div class="single-benefit d-flex align-items-start mb-4 wow fadeInUp" data-wow-delay=".2s">
                    <i class="lni lni-cog me-3 fs-3 text-success"></i>
                    <div>
                        <h4 class="h5 mb-1">Otomatisasi Operasional</h4>
                        <p class="text-muted">Mengurangi beban kerja administrasi seperti pengumpulan formulir dan entri data manual.</p>
                    </div>
                </div>
                
                <div class="single-benefit d-flex align-items-start mb-4 wow fadeInUp" data-wow-delay=".3s">
                    <i class="lni lni-graph me-3 fs-3 text-success"></i>
                    <div>
                        <h4 class="h5 mb-1">Analisis Kinerja Cepat</h4>
                        <p class="text-muted">Mendapatkan laporan pendaftaran dan statistik anggota secara instan untuk pengambilan keputusan.</p>
                    </div>
                </div>
                
                <div class="single-benefit d-flex align-items-start mb-4 wow fadeInUp" data-wow-delay=".4s">
                    <i class="lni lni-users me-3 fs-3 text-success"></i>
                    <div>
                        <h4 class="h5 mb-1">Manajemen Data Sentral</h4>
                        <p class="text-muted">Semua data anggota tersimpan terpusat, menghindari duplikasi dan mempermudah akses.</p>
                    </div>
                </div>
                
                <div class="single-benefit d-flex align-items-start mb-4 wow fadeInUp" data-wow-delay=".5s">
                    <i class="lni lni-thumbs-up me-3 fs-3 text-success"></i>
                    <div>
                        <h4 class="h5 mb-1">Peningkatan Reputasi</h4>
                        <p class="text-muted">Menunjukkan komitmen sanggar terhadap modernisasi dan pelayanan berbasis teknologi.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- <div class="text-center mt-5">
            <a href="<= base_url('informasi-detail') ?>" class="main-btn btn-hover border-btn">
                Detail Lengkap <i class="lni lni-arrow-right-circle ms-2"></i>
            </a>
        </div> -->
    </div>
</section>
	<!-- ========================= about-section end ========================= -->

	<!-- ========================= feature-section start ========================= -->
	<section id="about" class="about-section pt-120 pb-120">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <div class="section-title mb-60">
                    <h2 class="mb-20">Mengapa Memilih Sanggar Gayatri Art?</h2>
                    <p>Kami menawarkan lebih dari sekadar kelas tari. Kami berkomitmen pada pengembangan bakat, disiplin, dan apresiasi budaya bagi setiap anggota.</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="feature-slider-wrapper">
                    <div class="feature-slider tns-outer" id="featureSlider">
                        
                        <div class="single-slide-feature">
                            <div class="feature-card">
                                <div class="feature-icon-lg mb-3">
                                    <i class="lni lni-graduation"></i>
                                </div>
                                <h4>Kurikulum Berjenjang</h4>
                                <p>Program disusun sistematis dari tingkat dasar hingga mahir, menjamin perkembangan kemampuan yang terukur.</p>
                            </div>
                        </div>

                        <div class="single-slide-feature">
                            <div class="feature-card">
                                <div class="feature-icon-lg mb-3">
                                    <i class="lni lni-users"></i>
                                </div>
                                <h4>Pelatih Profesional</h4>
                                <p>Dibimbing oleh penari dan koreografer berpengalaman yang aktif di panggung nasional maupun regional.</p>
                            </div>
                        </div>

                        <div class="single-slide-feature">
                            <div class="feature-card">
                                <div class="feature-icon-lg mb-3">
                                    <i class="lni lni-book"></i>
                                </div>
                                <h4>Fokus Tari Tradisional</h4>
                                <p>Mendalami kekayaan tari klasik Jawa, memberikan pemahaman mendalam tentang filosofi dan budaya lokal.</p>
                            </div>
                        </div>

                        <div class="single-slide-feature">
                            <div class="feature-card">
                                <div class="feature-icon-lg mb-3">
                                    <i class="lni lni-cup"></i>
                                </div>
                                <h4>Kesempatan Pementasan</h4>
                                <p>Anggota mendapat prioritas untuk tampil dalam event, festival, dan pentas seni rutin yang diadakan sanggar.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
	<!-- ========================= feature-section end ========================= -->
	 
	<!-- ========================= pricing-section start ========================= -->
	<section id="harga" class="pricing-section pt-120 pb-120" style="background-color: #f7f7f7;">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <div class="section-title mb-60">
                    <h2 class="mb-20">Biaya dan Jadwal Kelas Sanggar</h2>
                    <p>Temukan program latihan yang sesuai dengan kebutuhan dan usia Anda. Kami menawarkan program terbuka untuk anak dan dewasa.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            
            <div class="col-lg-7 mb-4">
                <div class="p-4 bg-white rounded shadow-sm wow fadeInUp" data-wow-delay=".2s">
                    <h3 class="mb-3 text-primary">Jadwal Latihan Reguler (2x Seminggu)</h3>
                    <p class="text-muted mb-4">Dibuka untuk umum (minimal usia 5 tahun) dengan jadwal latihan 2x seminggu.</p>
                    
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
                            // Mengelompokkan data berdasarkan tipe kelas (ANAK/DEWASA)
                            $grouped_jadwal = [];
                            foreach ($jadwal_reguler as $j) {
                                $tipe = strtoupper($j['tipe_kelas']); // Misal: 'ANAK' atau 'DEWASA'
                                if (!isset($grouped_jadwal[$tipe])) {
                                    $grouped_jadwal[$tipe] = [];
                                }
                                $grouped_jadwal[$tipe][] = $j;
                            }
                            
                            if (!empty($grouped_jadwal)): 
                                foreach ($grouped_jadwal as $tipe => $list_jadwal): 
                                    ?>
                                    <tr>
                                        <td class="fw-bold" colspan="3">KELAS <?= esc($tipe) ?></td>
                                    </tr>
                                    <?php foreach ($list_jadwal as $j): ?>
                                        <tr>
                                            <td><?= esc($j['nama_kelas']) ?></td>
                                            <td><?= esc($j['hari']) ?></td>
                                            <td><?= esc($j['waktu']) ?></td>
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

            <div class="col-lg-5 mb-4">
                <div class="p-4 bg-white rounded shadow-sm wow fadeInUp" data-wow-delay=".4s" style="height: 100%;">
                    <h3 class="mb-3 text-success">Rincian Biaya</h3>
                    
                    <div class="price-info mb-4">
                            <ul class="list-unstyled">
                            <?php 
                            // Inisialisasi variabel default
                            $biaya_pendaftaran = 'Rp -';
                            $biaya_iuran = 'Rp -';
                            
                            // Mencari dan memformat harga dari database
                            if (!empty($biaya)) {
                                foreach ($biaya as $b) {
                                    $jumlah_format = 'Rp ' . number_format($b['jumlah'], 0, ',', '.');
                                    
                                    if (strpos(strtolower($b['jenis_biaya']), 'pendaftaran') !== false) {
                                        $biaya_pendaftaran = $jumlah_format;
                                    }
                                    if (strpos(strtolower($b['jenis_biaya']), 'iuran bulanan') !== false) {
                                        $biaya_iuran = $jumlah_format;
                                    }
                                }
                            }
                            ?>
                                <li class="h5 mb-3">Biaya Pendaftaran: <span class="text-danger fw-bold"><?= $biaya_pendaftaran ?></span> (dibayarkan di awal)</li>
                                <li class="h5 mb-4">Biaya Iuran Bulanan: <span class="text-danger fw-bold"><?= $biaya_iuran ?></span></li>
                            </ul>
                        </div>
                    
                    <hr>

                    <h4 class="mb-3">Kelas Private (Eksklusif)</h4>
                    <p class="text-muted mb-4">Untuk kebutuhan pelatihan yang lebih intensif, personal, atau khusus event. Hubungi admin untuk detail kurikulum dan harga.</p>
                    
                    <a href="https://wa.me/8193131862127?text=Halo%20Admin%20Sanggar%20Gayatri%20Art,%20saya%20tertarik%20dengan%20Kelas%20Private." 
                       target="_blank" 
                       class="main-btn btn-hover">
                        <i class="lni lni-whatsapp me-2"></i> Konsultasi Kelas Private
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
	<!-- ========================= pricing-section end ========================= -->

	<!-- ========================= karya-section start ========================= -->
	<section id="karya" class="cta-section pt-130 pb-100" style="background-color: #f7f7f7;">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-7 col-md-10">
                <div class="cta-content-wrapper">
                    <div class="section-title">
                        <h2 class="mb-20">Jelajahi Karya dan Prestasi Sanggar Gayatri Art</h2>
                        <p class="mb-30">Karya kami adalah cerminan dedikasi dan bakat para anggota. Kami aktif menghasilkan berbagai koreografi baru, baik untuk pementasan budaya lokal, kompetisi tari, maupun karya orisinal yang dapat Anda saksikan melalui kanal YouTube kami. Lihatlah bagaimana anggota kami berkreasi dan menorehkan prestasi!</p>
                        
                        <h4 class="mt-4">Kunjungi Galeri Kami:</h4>
                        <a href="<?= base_url('galeri') ?>" class="main-btn btn-hover border-btn me-3">
                            <i class="lni lni-gallery me-2"></i> Karya Lomba & Festival
                        </a>
                        <a href="https://youtube.com/@gaya3art?si=ju_YyiEz4h2VbSb-" target="_blank" class="main-btn btn-hover">
                            <i class="lni lni-youtube me-2"></i> Koreografi di YouTube
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="cta-image text-lg-end mt-5 mt-lg-0">
                    <img src="assets/images/cta/cta-image.svg" alt="Ilustrasi Tari">
                </div>
            </div>
            
        </div>
    </div>
</section>
	<!-- ========================= karya-section end ========================= -->



	<!-- ========================= footer start ========================= -->
	<footer class="footer pt-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10">
                <div class="footer-widget text-center">
                    <div class="logo">
                        <a href="<?= base_url() ?>"> 
                            <img src="<?= base_url('admin/img/GA.png') ?>" alt="logo" style="width: 100px; height: auto"> 
                        </a>
                    </div>
                    <h4 class="mt-3 mb-4"> Sanggar Seni Gayatri Art </h4>

                    <h5 class="mt-4 mb-2" style="text-align: left;">Kontak Kami</h5>
                    <ul class="links list-unstyled" style="text-align: left;">
                        <li><i class="lni lni-phone me-2"></i> Telp/WA: 081931318127</li>
                    </ul>

                    <h5 class="mt-4 mb-2" style="text-align: left;">Media Sosial</h5>
                    <ul class="social-links justify-content-center">
                        <li><a href="https://www.instagram.com/gayatri_artc?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank"><i class="lni lni-instagram"></i></a></li>
                        <li><a href="https://youtube.com/@gaya3art?si=ju_YyiEz4h2VbSb-" target="_blank"><i class="lni lni-youtube"></i></a></li>
						<li><a href="https://www.tiktok.com/@gayatriart0?_r=1&_t=ZS-91AUpFvd57K" target="_blank">
							<i class="fab fa-tiktok"></i>
						</a></li>
					</ul>

                    <p class="copyright-text mt-4">
                        © all rights reserved by okvy anggreani | sistem informasi</a>
                    </p>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 offset-xl-1">
                <div class="footer-widget">
                    <h3>Alamat Kantor</h3>
                    <ul class="links list-unstyled">
                        <li>(Detail alamat kantor Sanggar Gayatri Art)</li>
                        <li class="mt-3">
                            <a href="https://maps.app.goo.gl/ErbBYzjEHGvvswq69" target="_blank" class="main-btn btn-hover btn-sm">
                                Lihat di Peta
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="footer-widget">
                    <h3>Tempat Latihan</h3>
                    <ul class="links list-unstyled">
                        <li>(Detail alamat tempat latihan Sanggar Gayatri Art)</li>
                        <li class="mt-3">
                            <a href="https://maps.app.goo.gl/5mb2wsvUZCggBAXV8" target="_blank" class="main-btn btn-hover btn-sm">
                                Lihat di Peta
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            </div>
    </div>
</footer>
	<!-- ========================= footer end ========================= -->


	<!-- ========================= scroll-top ========================= -->
	<a href="#" class="scroll-top btn-hover">
		<i class="lni lni-chevron-up"></i>
	</a>

	<!-- ========================= JS here ========================= -->
	<script src="assets/js/bootstrap-5.0.0-beta2.min.js"></script>
	<script src="assets/js/tiny-slider.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<script src="assets/js/polyfill.js"></script>
	<script src="assets/js/main.js"></script>
</body>

</html>