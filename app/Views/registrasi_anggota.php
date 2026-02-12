<!DOCTYPE html>
<html class="no-js" lang="id">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Daftar Akun Anggota | Sanggar Gayatri Art</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" /> 
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('admin/img/GA.png') ?>" />
  
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-5.0.0-beta2.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/LineIcons.2.0.css') ?>" />
  
  <style>
    :root { --primary-blue: #007bff; }
    body {
      background-color: var(--primary-blue);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 0;
      font-family: 'Segoe UI', sans-serif;
    }
    .form-box {
      background: #fff;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }
    .form-control {
      border-radius: 10px;
      border: 1px solid #dee2e6;
      padding: 12px 15px;
      background-color: #f8f9fa;
    }
    /* Styling untuk pembungkus password */
    .password-wrapper {
      position: relative;
    }
    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
      z-index: 10;
    }
    .main-btn {
      width: 100%;
      background: var(--primary-blue);
      color: #fff;
      border: none;
      padding: 12px;
      border-radius: 10px;
      font-weight: 600;
      transition: 0.3s;
    }
    .main-btn:hover { background: #0056b3; color: #fff; }
    .btn-back-home {
      display: inline-flex;
      align-items: center;
      text-decoration: none;
      color: var(--primary-blue);
      border: 1px solid var(--primary-blue);
      padding: 5px 15px;
      border-radius: 8px;
      font-size: 0.85rem;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-8"> 
        <div class="form-box">
          <div class="text-center mb-3">
            <img src="<?= base_url('admin/img/GA.png') ?>" alt="Logo" style="width: 70px;">
          </div>

          <div class="text-start">
            <a href="<?= base_url() ?>" class="btn-back-home">
              <i class="lni lni-arrow-left me-2"></i> Beranda
            </a>
          </div>
          
          <h2 class="text-center fw-bold">Buat Akun</h2>
          <h5 class="text-center text-muted mb-4">Langkah 1 dari 2: Informasi Login Akun</h5>

                    <?php if (session()->getFlashdata('errors')): ?>
              <div class="alert alert-danger">
                  <ul>
                      <?php foreach (session()->getFlashdata('errors') as $error): ?>
                          <li><?= $error ?></li>
                      <?php endforeach; ?>
                  </ul>
              </div>
          <?php endif; ?>

          <form action="<?= base_url('register/simpan') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
              <label class="fw-bold small mb-1">Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            </div>

            <div class="mb-3">
              <label class="fw-bold small mb-1">Username</label>
              <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="mb-3">
              <label class="fw-bold small mb-1">Password</label>
              <div class="password-wrapper">
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                <i class="lni lni-eye toggle-password" onclick="togglePass('password', this)"></i>
              </div>
            </div>

            <div class="mb-4">
              <label class="fw-bold small mb-1">Konfirmasi Password</label>
              <div class="password-wrapper">
                <input type="password" name="pass_confirm" id="pass_confirm" class="form-control" placeholder="••••••••" required>
                <i class="lni lni-eye toggle-password" onclick="togglePass('pass_confirm', this)"></i>
              </div>
            </div>

            <button type="submit" class="main-btn">Buat Akun Sekarang</button>
          </form>
          
          <div class="text-center mt-4 small">
            Sudah punya akun? <a href="<?= base_url('login') ?>" class="text-primary fw-bold">Login di sini</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePass(inputId, icon) {
      const input = document.getElementById(inputId);
      if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("lni-eye", "lni-eye-slashed"); // Mengubah ikon mata
      } else {
        input.type = "password";
        icon.classList.replace("lni-eye-slashed", "lni-eye");
      }
    }
  </script>
</body>
</html>