<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get('nama') ?></span>
                <img class="img-profile rounded-circle" style="object-fit: cover; width: 30px; height: 30px;"
                    src="<?= (isset($anggota['foto_profil']) && !empty($anggota['foto_profil'])) ? base_url('uploads/fotoprofil/' . $anggota['foto_profil']) : base_url('admin/img/undraw_profile.svg') ?>">
            </a> <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="p-3 text-center">
                    <img class="img-profile rounded-circle mb-2" style="object-fit: cover; width: 60px; height: 60px;"
                        src="<?= (isset($anggota['foto_profil']) && !empty($anggota['foto_profil'])) ? base_url('uploads/fotoprofil/' . $anggota['foto_profil']) : base_url('admin/img/undraw_profile.svg') ?>">
                    <p class="mb-0 font-weight-bold text-gray-800"><?= $anggota['nama'] ?? session()->get('nama') ?></p>
                </div>
                
                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" href="<?= base_url('anggota/profil/detail') ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil Saya
                </a>
                <a class="dropdown-item" href="<?= base_url('anggota/ganti-password') ?>">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ganti Password
                </a>
                
                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>