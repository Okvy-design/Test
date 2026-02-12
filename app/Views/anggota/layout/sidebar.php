<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('anggota/dashboard') ?>">
        <div class="sidebar-brand-icon mb-2">
            <img src="<?= base_url('admin/img/GA.png') ?>" alt="Logo Gayatri Art" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
        </div> 
        <div class="sidebar-brand-text mx-3">PORTAL ANGGOTA</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= (uri_string() == 'anggota/profil') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('anggota/profil') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

  

    <hr class="sidebar-divider">

    <li class="nav-item <?= (uri_string() == 'anggota/profil/detail') ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('anggota/profil/detail') ?>">
        <i class="fas fa-user"></i>
        <span>Profil Saya</span>
    </a>
    </li>

    <li class="nav-item <?= (uri_string() == 'anggota/jadwal') ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('anggota/jadwal') ?>">
        <i class="fas fa-calendar-alt"></i>
        <span>Jadwal Kelas Saya</span>
    </a>
</li>
    
    <li class="nav-item <?= (uri_string() == 'anggota/kehadiran') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('anggota/kehadiran') ?>">
            <i class="fas fa-clipboard-list"></i>
            <span>Riwayat Kehadiran</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        
        <a href="<?= base_url('/') ?>" class="btn btn-light rounded-circle border-0 mb-2" title="Kembali ke Home">
            <i class="fas fa-home text-success"></i>
        </a>
        
        <br>

        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
   

</ul>