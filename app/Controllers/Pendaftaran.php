<?php

namespace App\Controllers;
use App\Models\AnggotaModel;

class Pendaftaran extends BaseController
{
    public function index()
    {
        return view('pendaftaran');
    }

    public function simpan()
    {
        $model = new AnggotaModel();
    
        // ... (LOGIKA PEMBUATAN ID ANGGOTA UNIK YANG SAYA BERIKAN SEBELUMNYA) ...

        $tgl_daftar = date('Y-m-d');
        $year_yy = date('y', strtotime($tgl_daftar)); 
        $month = date('n', strtotime($tgl_daftar));  

        // 1. Tentukan Kode Periode (X)
        if ($month >= 5 && $month <= 7) {
            $periode_x = '01'; 
        } elseif ($month >= 8 && $month <= 10) {
            $periode_x = '02'; 
        } elseif ($month == 11 || $month == 12 || $month == 1) {
            $periode_x = '03'; 
        } else { // $month >= 2 && $month <= 4
            $periode_x = '04'; 
        }
        
        // 2. Cari ID Anggota Terakhir untuk Periode ini
        $last_member = $model->getLastMemberIdByPeriod($year_yy, $periode_x);

        $next_nnn = 1; 
        if ($last_member) {
            $parts = explode('.', $last_member['id_anggota']);
            $last_nnn = (int) end($parts); 
            $next_nnn = $last_nnn + 1; 
        }

        // 3. Format NNN 
        $nnn_padded = str_pad($next_nnn, 3, '0', STR_PAD_LEFT);
        
        // 4. Susun ID Anggota Baru
        $new_id_anggota = $year_yy . '.A' . $periode_x . '.' . $nnn_padded;
        
        // --- AKHIR LOGIKA PEMBUATAN ID ANGGOTA UNIK ---

        $data = [
            'id_anggota'      => $new_id_anggota, // ID Anggota Baru
            // ... (Data lainnya) ...
            'nama'            => $this->request->getPost('nama'),
            'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
            'alamat'          => $this->request->getPost('alamat'),
            'no_hp'           => $this->request->getPost('no_hp'),
            'umur'            => $this->request->getPost('umur'),
            'tgl_lahir'       => $this->request->getPost('tgl_lahir'),
            'tgl_daftar'      => $tgl_daftar, 
            'pengalaman_tari' => $this->request->getPost('pengalaman_tari'),
            'status'          => 'tidak-aktif', 
        ];
    
        $model->insert($data);
    
        // Arahkan ke halaman sukses dan kirimkan data ID Anggota
        return view('pendaftaran_sukses', ['id_anggota' => $new_id_anggota]);
    }
}
    
