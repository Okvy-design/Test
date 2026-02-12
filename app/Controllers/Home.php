<?php

namespace App\Controllers;

use App\Models\JadwalKelasModel;
use App\Models\BiayaPendaftaranModel; 
use App\Models\AnggotaModel;
use App\Models\InfoPendaftaranModel;
use App\Models\GaleriModel;

class Home extends BaseController
{
    protected $jadwalModel;
    protected $biayaModel;
    protected $anggotaModel;
    protected $infoModel;
    protected $galeriModel;

    // Konstruktor untuk inisialisasi Model
    public function __construct()
    {
        $this->jadwalModel = new JadwalKelasModel();
        $this->biayaModel = new BiayaPendaftaranModel(); 
        $this->anggotaModel = new AnggotaModel();
        $this->infoModel = new InfoPendaftaranModel();
        $this->galeriModel = new GaleriModel();
    }

    public function index(): string
    {
        $id_user = session()->get('id_user');
        $is_logged_in = false;
        $anggota_nama = 'Anggota';

        if ($id_user) {
            $is_logged_in = true;
            $anggota_nama = session()->get('nama') ?? $this->anggotaModel->find($id_user)['nama'];
        }

        $semua_jadwal = $this->jadwalModel->getJadwalDenganKelas();
        $jadwal_reguler_final = [];
        foreach ($semua_jadwal as $j) {
            if ($j['tipe_sesi'] == 'reguler') {
                $jadwal_reguler_final[] = $j;
            }
        }
       
        $biaya = $this->biayaModel->findAll(); 
        $data = [
            // KIRIM DATA YANG SUDAH DIFILTER KE VIEW
            'jadwal_reguler' => $jadwal_reguler_final, 
            'biaya' => $biaya,

            'is_logged_in' => $is_logged_in,
            'anggota_nama' => $anggota_nama,
        ];
        
        return view('home/index', $data);
    }
    
  
    public function lihat()
    {
        // ... (Kode untuk jadwal dan biaya tetap)
        $semua_jadwal = $this->jadwalModel->getJadwalDenganKelas();
        
        $jadwal_reguler_final = [];
        foreach ($semua_jadwal as $j) {
            if (isset($j['tipe_sesi']) && $j['tipe_sesi'] == 'reguler') {
                $jadwal_reguler_final[] = $j;
            }
        }
        
        $biaya = $this->biayaModel->findAll(); 
        
        // --- TAMBAHAN BARU ---
        $info_pendaftaran = $this->infoModel->getActiveInfo(); // Ambil info aktif
        
        // Logika untuk menentukan apakah pendaftaran sedang dibuka
        $pendaftaran_dibuka = false;
        if ($info_pendaftaran) {
            $tgl_mulai = strtotime($info_pendaftaran['tgl_mulai_daftar']);
            $tgl_akhir = strtotime($info_pendaftaran['tgl_akhir_daftar']);
            $sekarang = time();
            
            if ($sekarang >= $tgl_mulai && $sekarang <= $tgl_akhir) {
                $pendaftaran_dibuka = true;
            }
        }
        // --- END TAMBAHAN BARU ---

        $data = [
            'jadwal_reguler' => $jadwal_reguler_final, 
            'biaya' => $biaya,
            'info_pendaftaran' => $info_pendaftaran, // <-- KIRIM DATA INFO
            'pendaftaran_dibuka' => $pendaftaran_dibuka, // <-- KIRIM STATUS
            'title' => 'Informasi Sanggar | Sanggar Gayatri Art'
        ];
        
        return view('home/lihat', $data);
    }

    public function daftar()
    {
        return view('pendaftaran');
    }

    public function detail()
    {
        return view('home/detail');
    }

    public function galeri()
    {
        $data = [
            // Mengambil data berdasarkan kategori agar mudah ditampilkan di view
            'latihan'    => $this->galeriModel->where('kategori', 'latihan')->findAll(),
            'lomba'      => $this->galeriModel->where('kategori', 'lomba')->findAll(),
            'koreografi' => $this->galeriModel->where('kategori', 'koreografi')->findAll(),
        ];
        return view('home/galeri', $data);
    }
}