<!DOCTYPE html>
<html class="no-js" lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Pendaftaran Berhasil | Sanggar Gayatri Art</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('admin/img/GA.png') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-5.0.0-beta2.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/LineIcons.2.0.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />

    <style>
        .success-page {
            padding-top: 100px;
            padding-bottom: 100px;
            min-height: 100vh;
            background: #f8f9fa; /* Latar belakang abu-abu muda */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .success-box {
            background: #fff;
            padding: 50px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        .success-box h2 {
            font-weight: 700;
            color: #198754; /* Hijau Bootstrap Success */
            margin-bottom: 25px;
        }
        .success-box p {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        .whatsapp-link {
            display: block;
            margin: 25px auto;
            width: fit-content;
            /* Menggunakan gaya tombol utama dengan border hijau */
            background-color: #25d366; /* Warna WhatsApp */
            color: #fff !important;
            border: 2px solid #25d366;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .whatsapp-link:hover {
            background-color: #128c7e;
            color: #fff !important;
        }
        .note {
            font-style: italic;
            color: #6c757d;
        }
        .back-link {
            margin-top: 30px;
            color: #007bff;
            text-decoration: underline;
            display: block;
        }
        .logo-small {
            width: 60px;
            margin-bottom: 15px;
        }
    </style>
</head>

<<body>
    <div class="success-page">
        <div class="success-box">
            <img src="<?= base_url('admin/img/GA.png') ?>" alt="Logo Sanggar" class="logo-small">
            
            <h2 class="text-center">Profil Berhasil Dilengkapi!</h2>
            <p>Terima kasih, <?= $nama_anggota ?>! Data profil Anda telah tersimpan dan berhasil dikirimkan ke Admin.</p>
            
            <div style="background-color: #ffeeba; border: 1px solid #ffc300; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <p style="font-weight: bold; margin-bottom: 5px;">Status Anda saat ini: MENUNGGU VERIFIKASI</p>
                <p style="margin: 0;">Admin akan segera memeriksa berkas dan data yang Anda unggah.</p>
            </div>

            <p>Sambil menunggu verifikasi selesai, silakan bergabung ke grup WhatsApp resmi kami untuk info jadwal, kelas, dan notifikasi akun aktif:</p>

            <a href="https://chat.whatsapp.com/KHp4gIf3zFBJvmH7Gh4z9n?mode=hqrt3" target="_blank" class="whatsapp-link">
                <i class="lni lni-whatsapp me-2"></i> Gabung ke Grup WhatsApp Sanggar
            </a>

            <p class="note">Anda dapat login kembali sewaktu-waktu untuk melihat status keanggotaan Anda.</p>

            <a href="<?= base_url('logout') ?>" class="back-link">
                Keluar dan Selesaikan Sesi
            </a>
            
            </div>
    </div>
</body>
</html>