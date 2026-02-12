<?php

namespace App\Controllers\Anggota;

use App\Controllers\BaseController;
use App\Models\KehadiranModel;
use App\Models\DetailKehadiranModel;
use App\Models\AnggotaModel;

class Kehadiran extends BaseController
{
    protected $kehadiranModel;
    protected $detailModel;
    protected $anggotaModel;

    public function __construct()
    {
        $this->kehadiranModel = new KehadiranModel();
        $this->detailModel = new DetailKehadiranModel();
        $this->anggotaModel = new AnggotaModel();
        helper(['url', 'form']);
    }

    public function index()
{
    $id_session = session()->get('id_anggota'); 

    // Pastikan session ada agar tidak "id_anggota" undefined
    if (!$id_session) {
        return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu');
    }

    $anggota = $this->anggotaModel->select('anggota.*, kelas.nama_kelas')
        ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
        ->where('anggota.id_anggota', $id_session)
        ->first();

    $rekap = $this->detailModel->getRekapPerAnggota($id_session);

    $data = [
        'title'   => 'Riwayat Kehadiran Saya',
        'anggota' => $anggota,
        'rekap'   => $rekap,
        'content' => 'anggota/kehadiran/index' // Ganti 'isi' menjadi 'content' agar sesuai wrapper
    ];

    return view('anggota/layout/wrapper', $data); 
}

public function detail()
{
    $id_session = session()->get('id_anggota');

    // Ambil semua data kehadiran spesifik anggota ini
    $detailKehadiran = $this->detailModel->where('id_anggota', $id_session)
        ->orderBy('tanggal_pertemuan', 'DESC')
        ->findAll();

    $data = [
        'title'   => 'Detail Kehadiran',
        'detail'  => $detailKehadiran,
        'content' => 'anggota/kehadiran/detail' // Ini akan dipanggil oleh view($content) di wrapper
    ];

    return view('anggota/layout/wrapper', $data);
}
}