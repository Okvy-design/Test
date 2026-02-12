<?php

namespace App\Controllers\Anggota;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\JadwalKelasModel;

class Jadwal extends BaseController
{
    public function index()
    {
        $anggotaModel = new AnggotaModel();
        $jadwalModel = new JadwalKelasModel();

        $id_user = session()->get('id_user');
        
        // Ambil data anggota lengkap dengan nama kelas
        $anggota = $anggotaModel->getAnggotaWithKelas($id_user);

        $jadwal = [];
        if ($anggota && !empty($anggota['id_kelas'])) {
            // Ambil jadwal berdasarkan id_kelas (misal: KA002)
            $jadwal = $jadwalModel->where('id_kelas', $anggota['id_kelas'])->findAll();
        }
        $data = [
            'title'   => 'Jadwal Kelas Saya',
            'anggota' => $anggota,
            'jadwal'  => $jadwal,
            'content' => 'anggota/jadwal/index' // CUKUP TULIS PATH FILE SAJA
        ];
        
        return view('anggota/layout/wrapper', $data);
    }

}