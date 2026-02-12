<?php
namespace App\Controllers\Anggota;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KelasModel;

class Profil extends BaseController
{
    protected $anggotaModel;
    protected $kelasModel;
    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->kelasModel = new KelasModel();
        helper(['form']);
    }

    public function edit()
{
    $id_user = session()->get('id_user');
    
    // Ambil data anggota dengan JOIN Kelas untuk pengecekan status
    $data_anggota = $this->anggotaModel
        ->select('anggota.*, kelas.nama_kelas') 
        ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
        ->where('id_user', $id_user)
        ->first();
    
    // Cek Status: Jika statusnya Menunggu atau Keluar, larang akses edit
    if ($data_anggota && ($data_anggota['status'] == 'menunggu' || $data_anggota['status'] == 'keluar')) {
        // Arahkan ke dashboard utama yang menampilkan pesan status
        return redirect()->to(base_url('anggota/dashboard')); 
    }

    $data = [
        'title' => 'Lengkapi Data Pendaftaran',
        'anggota' => $data_anggota,
    ];

    return view('anggota/profil_edit', $data);
}

public function update()
{
    $id_user = session()->get('id_user');
    $anggota_saat_ini = $this->anggotaModel->where('id_user', $id_user)->first();
    
    // --- PENGECEKAN BLOKIR UPDATE ---
    // Jika status sudah 'menunggu' atau 'keluar', batalkan proses update dan redirect.
    if ($anggota_saat_ini && ($anggota_saat_ini['status'] == 'menunggu' || $anggota_saat_ini['status'] == 'keluar')) {
        session()->setFlashdata('error', 'Pembaruan data dibatalkan. Status Anda adalah ' . strtoupper($anggota_saat_ini['status']) . ', harap hubungi Admin.');
        return redirect()->to(base_url('anggota/dashboard')); 
    }
    // --- END PENGECEKAN BLOKIR UPDATE ---

    $anggota_pk = $anggota_saat_ini['id_anggota'];
    $tgl_daftar = $anggota_saat_ini['tgl_daftar'];

    // ... (sisa validasi dan perhitungan umur/kelas tetap sama) ...
    
    if (
        !$this->validate([
            // ... (validasi tetap sama) ...
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|valid_date',
            'no_hp' => 'required|numeric|min_length[10]',
            'alamat' => 'required',
            'file' => 'permit_empty|max_size[file,2048]|mime_in[file,image/jpg,image/jpeg,image/png,application/pdf]', // Tambahkan PDF
            'bukti_tf' => 'permit_empty|max_size[bukti_tf,2048]|mime_in[bukti_tf,image/jpg,image/jpeg,image/png]',
        ])
    ) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $tgl_lahir = $this->request->getPost('tgl_lahir');
    $bday = new \DateTime($tgl_lahir);
    $now = new \DateTime();
    $umur = $now->diff($bday)->y;
    $id_kelas_otomatis = $this->kelasModel->findKelasByUmur($umur);
    
    if (empty($id_kelas_otomatis)) {
        return redirect()->back()->withInput()->with('error', 'Umur ' . $umur . ' tahun tidak masuk dalam rentang kelas yang tersedia. Mohon hubungi Admin.');
    }

    // ... (Logika upload file dan logika pembentukan $data_update tetap sama) ...
    $file_datadiri_upload = $this->request->getFile('file');
    $file_transfer_upload = $this->request->getFile('bukti_tf');

    // Inisialisasi dengan nama file lama (data_saat_ini)
    $nama_datadiri = $anggota_saat_ini['file'];
    $nama_transfer = $anggota_saat_ini['bukti_tf'];
    
    // Logika Upload File Data Diri
    if ($file_datadiri_upload && $file_datadiri_upload->isValid() && !$file_datadiri_upload->hasMoved()) {
        if ($anggota_saat_ini['file'] && file_exists(ROOTPATH . 'public/uploads/datadiri/' . $anggota_saat_ini['file'])) {
            unlink(ROOTPATH . 'public/uploads/datadiri/' . $anggota_saat_ini['file']);
        }
        $nama_datadiri = 'datadiri_' . $id_user . '_' . time() . '.' . $file_datadiri_upload->getExtension();
        $file_datadiri_upload->move(ROOTPATH . 'public/uploads/datadiri', $nama_datadiri);
    }
    
    // Logika Upload Bukti Transfer
    if ($file_transfer_upload && $file_transfer_upload->isValid() && !$file_transfer_upload->hasMoved()) {
        if ($anggota_saat_ini['bukti_tf'] && file_exists(ROOTPATH . 'public/uploads/transfer/' . $anggota_saat_ini['bukti_tf'])) {
            unlink(ROOTPATH . 'public/uploads/transfer/' . $anggota_saat_ini['bukti_tf']);
        }
        $nama_transfer = 'transfer_' . $id_user . '_' . time() . '.' . $file_transfer_upload->getExtension();
        $file_transfer_upload->move(ROOTPATH . 'public/uploads/transfer', $nama_transfer);
    }
    
    // --- KONTROL ID ANGGOTA DAN STATUS ---
    $id_anggota_unik = $anggota_saat_ini['id_anggota'];
    $status_baru = $anggota_saat_ini['status']; // Default: pertahankan status saat ini

    // 🎯 LOGIKA PERBAIKAN: Jika ID Anggota belum unik (masih DUMMY/kosong) DAN status masih 'tidak-aktif'
    if (
        (empty($id_anggota_unik) || strpos($id_anggota_unik, 'DUMMY') !== false) && 
        $anggota_saat_ini['status'] == 'tidak-aktif'
    ) {
        // 1. Generate ID unik
        $id_anggota_unik = $this->anggotaModel->generateUniqueAnggotaId($tgl_daftar);
        
        // 2. Ubah status menjadi MENUNGGU
        $status_baru = 'menunggu';
    } 
    
    // --- PEMBENTUKAN DATA UPDATE ---
    $data_update = [
        'id_anggota' => $id_anggota_unik, // ID Anggota baru atau lama
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        'tgl_lahir' => $tgl_lahir,
        'umur' => $umur,
        'no_hp' => $this->request->getPost('no_hp'),
        'alamat' => $this->request->getPost('alamat'),
        'pengalaman_tari' => $this->request->getPost('pengalaman_tari'),
        'id_kelas' => $id_kelas_otomatis,
        'file' => $nama_datadiri,
        'bukti_tf' => $nama_transfer,
        'status' => $status_baru,
    ];
    
    $this->anggotaModel->update($anggota_pk, $data_update);
    
    // Redirect ke halaman sukses setelah update
    $data_view = [
        'nama_anggota' => session()->get('nama'),
        'title' => 'Pendaftaran Berhasil',
    ];
    return view('anggota/profil_sukses', $data_view);
}

    public function lihat()
    {
        // Pastikan Anda mendapatkan ID Anggota dari sesi
        $id_user = session()->get('id_user'); 
        
        if (!$id_user) {
            return redirect()->to(base_url('login'))->with('error', 'Anda harus login untuk melihat profil.');
        }

        // Load Model Anggota (Pastikan sudah didefinisikan di constructor)
        $anggotaModel = new \App\Models\AnggotaModel();
        $data_anggota = $anggotaModel->getAnggotaWithKelas($id_user); // Gunakan fungsi yang mengambil semua data

        if (!$data_anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        $data = [
            'title' => 'Lihat Data Profil',
            'anggota' => $data_anggota,
        ];

        // Menggunakan view baru yang kita buat
        return view('anggota/profil_lihat', $data); 
    }

    //baru 
    public function index()
    {
        $id_user = session()->get('id_user');
        
        // Ambil data anggota menggunakan model
        $data_anggota = $this->anggotaModel->getAnggotaWithKelas($id_user);
        
        // 1. Proteksi jika data tidak ada
        if (!$data_anggota) {
            return redirect()->to(base_url('login'))->with('error', 'Data anggota tidak ditemukan.');
        }
    
        // 2. Proteksi Status (Hanya yang aktif bisa masuk portal)
        if ($data_anggota['status'] !== 'aktif') {
            return redirect()->to(base_url('login'))->with('error', 'Akun Anda belum aktif. Silakan hubungi Admin.');
        }
    
        // 3. Siapkan Data untuk dikirim ke View
        $data = [
            'title'      => 'Dashboard Anggota',
            'anggota'    => $data_anggota,
            'validation' => \Config\Services::validation(),
            'content'    => 'anggota/profil/index' // KIRIM ALAMAT FILE-NYA SAJA (STRING)
        ];
    
        // 4. Panggil Wrapper Utama
        return view('anggota/layout/wrapper', $data);
    }
/**
 * Method untuk Update Profil Anggota AKTIF (Modifikasi untuk menerima field baru)
 */
public function update_aktif() 
{
  $id_user = session()->get('id_user');
  $anggota_saat_ini = $this->anggotaModel->where('id_user', $id_user)->first();
  

  if (!$anggota_saat_ini || $anggota_saat_ini['status'] !== 'aktif') {
    session()->setFlashdata('error', 'Pembaruan data hanya diizinkan untuk anggota aktif.');
    return redirect()->to(base_url('anggota/dashboard')); 
  }


  $anggota_pk = $anggota_saat_ini['id_anggota'];


  if (
    !$this->validate([
      'nama' => 'required',
      'no_hp' => 'required|numeric|min_length[10]',
      'alamat' => 'required',
      'pengalaman_tari' => 'permit_empty',
      'foto_profil' => 'permit_empty|max_size[foto_profil,1024]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]', 
    ])
  ) {
    return redirect()->to(base_url('anggota/profil'))->withInput()->with('errors', $this->validator->getErrors());
  }

  $foto_profil_upload = $this->request->getFile('foto_profil');


  $nama_foto_profil = $anggota_saat_ini['foto_profil'];
  

  if ($foto_profil_upload && $foto_profil_upload->isValid() && !$foto_profil_upload->hasMoved()) {
    if ($anggota_saat_ini['foto_profil'] && file_exists(ROOTPATH . 'public/uploads/fotoprofil/' . $anggota_saat_ini['foto_profil'])) {
      unlink(ROOTPATH . 'public/uploads/fotoprofil/' . $anggota_saat_ini['foto_profil']);
    }
    $nama_foto_profil = 'profil_' . $id_user . '_' . time() . '.' . $foto_profil_upload->getExtension();
    $foto_profil_upload->move(ROOTPATH . 'public/uploads/fotoprofil', $nama_foto_profil);
  }
  
  $data_update = [
    'nama' => $this->request->getPost('nama'),
    'no_hp' => $this->request->getPost('no_hp'),
    'alamat' => $this->request->getPost('alamat'),
    'pengalaman_tari' => $this->request->getPost('pengalaman_tari'),
    'foto_profil' => $nama_foto_profil,

  ];
  
  $this->anggotaModel->update($anggota_pk, $data_update);
  
  session()->setFlashdata('success', 'Profil berhasil diperbarui!');
  return redirect()->to(base_url('anggota/profil'));
}

// Tambahkan method ini di Profil.php
public function detail()
{
    $id_user = session()->get('id_user');
    $data_anggota = $this->anggotaModel->getAnggotaWithKelas($id_user);

    if (!$data_anggota || $data_anggota['status'] !== 'aktif') {
        return redirect()->to(base_url('login'))->with('error', 'Akses ditolak.');
    }

    $data = [
        'title'   => 'Profil Lengkap Anggota',
        'anggota' => $data_anggota,
        'content' => 'anggota/profil/detail' // Arahkan ke file view baru
    ];

    return view('anggota/layout/wrapper', $data);
}

}