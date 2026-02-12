<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KelasModel;

class Dashboard extends BaseController
{
    protected $anggotaModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->kelasModel = new KelasModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/adminlogin');
        }
        $today = date('Y-m-d');
        $thisMonth = date('m');
        $thisYear = date('Y');

        // Ambil data asli
        $totalAnggota = $this->anggotaModel->countAll();
        $jumlahKelas = $this->kelasModel->countAll();

        $menungguHariIni = $this->anggotaModel
        ->where('status', 'menunggu')
        ->where('DATE(tgl_daftar)', $today)
        ->countAllResults();

        $aktifBulanIni = $this->anggotaModel
        ->where('status', 'aktif')
        ->where('MONTH(tgl_daftar)', $thisMonth)
        ->where('YEAR(tgl_daftar)', $thisYear)
        ->countAllResults();

        $anggotaLaki = $this->anggotaModel
            ->where(['status' => 'Aktif', 'jenis_kelamin' => 'Laki-laki'])
            ->countAllResults();
        $anggotaPerempuan = $this->anggotaModel
            ->where(['status' => 'Aktif', 'jenis_kelamin' => 'Perempuan'])
            ->countAllResults();

        $data = [
            'title' => 'Dashboard Admin',
            'totalAnggota' => $totalAnggota,
            'jumlahKelas' => $jumlahKelas,
            'menungguHariIni' => $menungguHariIni,
            'aktifBulanIni' => $aktifBulanIni,
            'anggotaLaki' => $anggotaLaki,
            'anggotaPerempuan' => $anggotaPerempuan,
        ];

        return view('admin/dashboard', $data);
    }
}
