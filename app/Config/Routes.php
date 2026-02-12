<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =======================================================
// ROUTE KHUSUS: PUBLIK
// =======================================================

$routes->get('/', 'Home::index');
$routes->get('join', 'Home::daftar');

$routes->get('/dashboard', 'Dashboard::index',);
$routes->get('home/lihat', 'Home::lihat');
$routes->get('informasi-detail', 'Home::detail');
$routes->get('galeri', 'Home::galeri');

// Rute Registrasi Anggota 
$routes->get('register', 'Register::index');
$routes->post('register/simpan', 'Register::simpan');

// Group untuk anggota
// Route untuk halaman form ganti password
$routes->get('anggota/ganti-password', '\App\Controllers\Anggota\Password::index',['filter' => 'auth']);
$routes->post('anggota/update-password', '\App\Controllers\Anggota\Password::update', ['filter' => 'auth']);

// Rute Login Anggota/Admin 
$routes->get('login', 'Login::index');
$routes->post('login/auth', 'Login::auth');
$routes->get('logout', 'Login::logout'); 

// app/Config/Routes.php

$routes->get('anggota/dashboard', 'Anggota\Dashboard::index', ['filter' => 'auth']);
$routes->get('anggota/profil/edit', 'Anggota\Profil::edit', ['filter' => 'auth']);
$routes->post('anggota/profil/update', 'Anggota\Profil::update', ['filter' => 'auth']);
$routes->get('anggota/profil/lihat', 'Anggota\Profil::lihat', ['filter' => 'auth']);
$routes->get('anggota/profil/sukses', 'Anggota\Profil::sukses', ['filter' => 'auth']);

// Dashboard Utama Anggota Aktif
$routes->get('anggota/index', 'Anggota\Dashboard::index', ['filter' => 'auth']); 

// Portal Profil Anggota Aktif
$routes->get('anggota/profil', 'Anggota\Profil::index', ['filter' => 'auth']); 
$routes->post('anggota/profil/update_aktif', 'Anggota\Profil::update_aktif', ['filter' => 'auth']);
$routes->get('anggota/jadwal', 'Anggota\Jadwal::index', ['filter' => 'auth']);
// Routes Portal Anggota
$routes->get('anggota/kehadiran', 'Anggota\Kehadiran::index', ['filter' => 'auth']);
$routes->get('anggota/kehadiran/detail', 'Anggota\Kehadiran::detail', ['filter' => 'auth']);
$routes->get('anggota/ganti-password', 'Anggota\Profil::ganti_password', ['filter' => 'auth']);

$routes->get('anggota/profil/detail', 'Anggota\Profil::detail', ['filter' => 'auth']);
// =======================================================
// ROUTE KHUSUS: ADMIN
// =======================================================

// Rute Dashboard Admin
$routes->get('admin/dashboard', 'Admin\Dashboard::index', ['filter' => 'adminauth']);

// Rute Admin Kelola Jadwal Sanggar yang ditampilkan di landing page
$routes->get('admin/jadwal-sanggar', 'Admin\JadwalKelas::index', ['filter' => 'adminauth']);
$routes->get('admin/jadwal-sanggar/create', 'Admin\JadwalKelas::create', ['filter' => 'adminauth']);
$routes->get('admin/jadwal-sanggar/delete/(:segment)', 'Admin\JadwalKelas::delete/$1', ['filter' => 'adminauth']);
$routes->post('admin/jadwal-sanggar/store', 'Admin\JadwalKelas::store', ['filter' => 'adminauth']);
$routes->get('admin/jadwal-sanggar/edit/(:segment)', 'Admin\JadwalKelas::edit/$1'); 
$routes->put('admin/jadwal-sanggar/update/(:segment)', 'Admin\JadwalKelas::update/$1');

//Rute Admin olah galeri
$routes->get('admin/galeri', 'Admin\Galeri::index',['filter' => 'adminauth']);
$routes->post('admin/galeri/save', 'Admin\Galeri::save',['filter' => 'adminauth']);
$routes->post('admin/galeri/update', 'Admin\Galeri::update',['filter' => 'adminauth']); 
$routes->get('admin/galeri/delete/(:any)', 'Admin\Galeri::delete/$1',['filter' => 'adminauth']);

//rute admin kelola user
$routes->get('admin/user', 'Admin\User::index');
$routes->get('admin/user/create', 'Admin\User::create');
$routes->post('admin/user/save', 'Admin\User::save');
$routes->get('admin/user/edit/(:num)', 'Admin\User::edit/$1');
$routes->post('admin/user/update/(:num)', 'Admin\User::update/$1');
$routes->get('admin/user/delete/(:num)', 'Admin\User::delete/$1');

//rute admin ganti password
$routes->get('admin/user/change-password', 'Admin\User::changePassword');
$routes->post('admin/user/update-password', 'Admin\User::updatePassword');

//Rute Admin Kelola INFO PENDAFTARAN
$routes->get('admin/info-pendaftaran', 'Admin\InfoPendaftaran::index', ['filter' => 'adminauth']);
$routes->post('admin/info-pendaftaran/update', 'Admin\InfoPendaftaran::update', ['filter' => 'adminauth']);

// Rute Admin Kelola Biaya yang ditampilkan di landing page
$routes->get('admin/biaya', 'Admin\BiayaPendaftaran::index', ['filter' => 'adminauth']);
$routes->post('admin/biaya/update', 'Admin\BiayaPendaftaran::update', ['filter' => 'adminauth']);
$routes->post('admin/biaya/add', 'Admin\BiayaPendaftaran::add', ['filter' => 'adminauth']);
$routes->get('admin/biaya/delete/(:any)', 'Admin\BiayaPendaftaran::delete/$1', ['filter' => 'adminauth']);

// Rute Admin Kelola Data Anggota
$routes->get('admin/anggota', 'Admin\Anggota::index', ['filter' => 'adminauth']);
$routes->get('admin/anggota/create', 'Admin\Anggota::create', ['filter' => 'adminauth']);
$routes->post('admin/anggota/store', 'Admin\Anggota::store', ['filter' => 'adminauth']);
$routes->get('admin/anggota/edit/(:any)', 'Admin\Anggota::edit/$1', ['filter' => 'adminauth']);
$routes->get('admin/anggota/detail/(:segment)', 'Admin\Anggota::detail/$1', ['filter' => 'adminauth']);
$routes->post('admin/anggota/update/(:any)', 'Admin\Anggota::update/$1', ['filter' => 'adminauth']);
$routes->get('admin/anggota/delete/(:any)', 'Admin\Anggota::delete/$1', ['filter' => 'adminauth']);

// Rute Admin Kelola Data Pelatih
$routes->get('admin/pelatih', 'Admin\Pelatih::index', ['filter' => 'adminauth']);
$routes->get('admin/pelatih/tambah', 'Admin\Pelatih::tambah', ['filter' => 'adminauth']);
$routes->post('admin/pelatih/simpan', 'Admin\Pelatih::simpan', ['filter' => 'adminauth']);
$routes->get('admin/pelatih/edit/(:any)', 'Admin\Pelatih::edit/$1', ['filter' => 'adminauth']);
$routes->post('admin/pelatih/update/(:any)', 'Admin\Pelatih::update/$1', ['filter' => 'adminauth']);
$routes->get('admin/pelatih/hapus/(:any)', 'Admin\Pelatih::hapus/$1', ['filter' => 'adminauth']);

//Rute Admin Kelola Data Kelas
$routes->get('/admin/kelas', 'Admin\Kelas::index', ['filter' => 'adminauth']);
$routes->get('/admin/kelas/tambah', 'Admin\Kelas::tambah', ['filter' => 'adminauth']);
$routes->post('/admin/kelas/simpan', 'Admin\Kelas::simpan', ['filter' => 'adminauth']);
$routes->get('/admin/kelas/edit/(:segment)', 'Admin\Kelas::edit/$1', ['filter' => 'adminauth']); 
$routes->post('/admin/kelas/update/(:segment)', 'Admin\Kelas::update/$1', ['filter' => 'adminauth']);
$routes->get('/admin/kelas/hapus/(:segment)', 'Admin\Kelas::hapus/$1', ['filter' => 'adminauth']);

//Rute Admin Kelola jadwal Kelompok 
$routes->get('admin/jadwal', 'Admin\Jadwal::index', ['filter' => 'adminauth']);
$routes->get('admin/jadwal/detail/(:segment)', 'Admin\Jadwal::detail/$1', ['filter' => 'adminauth']);
$routes->get('admin/jadwal/cetak/(:segment)', 'Admin\Jadwal::cetak/$1', ['filter' => 'adminauth']);
$routes->get('admin/jadwal/move_anggota/(:segment)', 'Admin\Jadwal::moveAnggotaForm/$1', ['filter' => 'adminauth']);
$routes->post('admin/jadwal/move_anggota_update/(:segment)', 'Admin\Jadwal::moveAnggotaUpdate/$1', ['filter' => 'adminauth']);

//Rute Admin Kelola Laporan
// Routes untuk Menu Laporan (Tanpa Group)
$routes->get('admin/laporan', 'Admin\Laporan::index',['filter' => 'adminauth']);
$routes->post('admin/laporan/cetak', 'Admin\Laporan::cetak', ['filter' => 'adminauth']);
$routes->get('admin/laporan/anggota', 'Admin\Laporan::anggota', ['filter' => 'adminauth']);
$routes->post('admin/laporan/cetak_anggota', 'Admin\Laporan::cetak_anggota', ['filter' => 'adminauth']);

//Rute Admin Kelola Data kehadiran
$routes->group('admin', function($routes){
    $routes->get('kehadiran', 'Admin\Kehadiran::index', ['filter' => 'adminauth']); 
    $routes->get('kehadiran/create', 'Admin\Kehadiran::create', ['filter' => 'adminauth']);
    $routes->post('kehadiran/save', 'Admin\Kehadiran::save', ['filter' => 'adminauth']);
    $routes->get('kehadiran/detail/(:any)', 'Admin\Kehadiran::detail/$1', ['filter' => 'adminauth']);
    $routes->get('kehadiran/view-pdf/(:any)', 'Admin\Kehadiran::viewPdf/$1', ['filter' => 'adminauth']);
});










