<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/dashboard') ?>">
  <div class="sidebar-brand-icon mb-2">
        <img src="<?= base_url('admin/img/GA.png') ?>" alt="Logo Gayatri Art" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
    </div> 
  <div class="sidebar-brand-text mx-3">GAYATRI ART</div>
  </a>

  <hr class="sidebar-divider my-0">

  <!-- Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <!-- menu pusat informasi -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePublik"
      aria-expanded="true" aria-controls="collapsePublik">
      <i class="fas fa-bullhorn"></i> <span>Pusat Informasi</span>
    </a>
    <div id="collapsePublik" class="collapse" aria-labelledby="headingPublik" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Info Publik:</h6>
        <a class="collapse-item" href="<?= base_url('admin/info-pendaftaran') ?>">Informasi Pendaftaran</a>
        <a class="collapse-item" href="<?= base_url('admin/jadwal-sanggar') ?>">Jadwal Sanggar</a>
        <a class="collapse-item" href="<?= base_url('admin/biaya') ?>">Biaya Pendaftaran</a>
        <a class="collapse-item" href="<?= base_url('admin/galeri') ?>">Galeri Karya</a> </div>
      </div>
</li>
<hr class="sidebar-divider">


  <!-- Master Menu (collapse) -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster"
      aria-expanded="true" aria-controls="collapseMaster">
      <i class="fas fa-database"></i>
      <span>Master</span>
    </a>
    <div id="collapseMaster" class="collapse" aria-labelledby="headingMaster" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Data Master:</h6>
        <a class="collapse-item" href="<?= base_url('admin/anggota') ?>">Anggota</a>
        <a class="collapse-item" href="<?= base_url('admin/pelatih') ?>">Pelatih</a>
        <a class="collapse-item" href="<?= base_url('admin/user') ?>">Pengguna</a>
      </div>
    </div>
  </li>

  
  <!-- Menu lain -->
  <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/kelas') ?>"><i class="fas fa-school"></i><span>Kelas</span></a></li>
  <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/jadwal') ?>"><i class="fas fa-calendar-alt"></i><span>Jadwal</span></a></li>
  <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/kehadiran') ?>"><i class="fas fa-check-square"></i><span>Kehadiran</span></a></li>

  <hr class="sidebar-divider">


<!-- laporan -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
      aria-expanded="true" aria-controls="collapseLaporan">
      <i class="fas fa-file-alt"></i> <span>Laporan</span>
    </a>
    <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Laporan Cetak:</h6>
        <a class="collapse-item" href="<?= base_url('admin/laporan') ?>">Laporan Kehadiran</a>
        <a class="collapse-item" href="<?= base_url('admin/laporan/anggota') ?>">Laporan Anggota</a>
        </div>
    </div>
  </li>


  <hr class="sidebar-divider d-none d-md-block">

  <li class="nav-item"><a class="nav-link" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
</ul>
<!-- End Sidebar -->
