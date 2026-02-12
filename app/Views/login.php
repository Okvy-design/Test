<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Akun | Gayatri Art</title>

    <link rel="icon" type="image/png" href="<?= base_url('admin/img/GA.png') ?>">
    <link rel="shortcut icon" href="<?= base_url('admin/img/GA.png') ?>"> 

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-blue: #007bff;
        }

        body {
            background-color: var(--primary-blue);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 1000px;
            max-width: 100%;
            display: flex;
            min-height: 600px;
            position: relative;
        }

        .login-side-image {
            flex: 1.2;
            background-image: url('<?= base_url('assets/images/galeri/gambar1.jpeg') ?>');
            background-size: cover;
            background-position: center;
            position: relative;
            display: none;
        }

        @media (min-width: 768px) {
            .login-side-image { display: block; }
        }

        .login-side-image::after {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.2);
        }

        .login-side-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .logo-box img {
            width: 70px;
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            background-color: #f8f9fa;
        }

        /* Styling untuk Fitur Lihat Password */
        .password-field {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            font-size: 1.2rem;
            z-index: 10;
        }

        .btn-login {
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            background-color: var(--primary-blue);
            margin-top: 10px;
            border: none;
        }

        .btn-back {
            position: absolute;
            top: 20px;
            right: 20px;
            text-decoration: none;
            color: #666;
            font-size: 0.9rem;
            transition: 0.3s;
            z-index: 20;
        }
        .btn-back:hover { color: var(--primary-blue); }

        .footer-text {
            margin-top: 30px;
            font-size: 0.85rem;
            color: #999;
        }
    </style>
</head>
<body>

<div class="login-container">
    <a href="<?= base_url('/') ?>" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>

    <div class="login-side-image"></div>

    <div class="login-side-form">
        <div class="text-center logo-box">
            <img src="<?= base_url('admin/img/GA.png') ?>" alt="Logo Gayatri Art">
            <h3 class="fw-bold">Login Akun</h3>
            <p class="text-muted small">Selamat datang kembali di Gayatri Art</p>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success py-2 small border-0 text-center">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger py-2 small border-0 text-center"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('login/auth') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label small fw-bold">Username</label>
                <input type="text" name="username" class="form-control" placeholder="" required>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold">Password</label>
                <div class="password-field">
                    <input type="password" name="password" id="loginPassword" class="form-control" placeholder="" required>
                    <i class="bi bi-eye toggle-password" id="toggleLoginPassword"></i>
                </div>
            </div>
            <button class="btn btn-primary btn-login w-100 shadow-sm" type="submit">Masuk</button>
        </form>

       

        <div class="text-center footer-text">
            © 2026 Gayatri Art Company
        </div>
    </div>
</div>

<script>
    // Script untuk Toggle Lihat Password
    const togglePassword = document.querySelector('#toggleLoginPassword');
    const passwordInput = document.querySelector('#loginPassword');

    togglePassword.addEventListener('click', function () {
        // Toggle tipe input
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Toggle ikon
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
</script>

</body>
</html>