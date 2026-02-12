<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $allowedFields = [
        'id_anggota','id_user','id_kelas', 
        'nama', 'jenis_kelamin', 'alamat', 'no_hp',
        'umur', 'tgl_lahir', 'tgl_daftar', 'pengalaman_tari',
        'status','file','bukti_tf','foto_profil'
    ];

    public function getLastMemberIdByPeriod($year_yy, $periode_x)
    {
        $prefix = $year_yy . '.A' . $periode_x . '.';
        
        return $this->select('id_anggota')
                    ->like('id_anggota', $prefix, 'after') 
                    ->orderBy('id_anggota', 'DESC')
                    ->first();
    }

// Tambahkan fungsi ini di dalam class AnggotaModel
public function getAnggotaByAngkatan(int $angkatan, int $tahun)
{
    // Tentukan rentang bulan berdasarkan logika angkatan Anda
    $bulan_range = [
        1 => ['01', '03'], // Jan-Mar
        2 => ['04', '06'], // Apr-Jun
        3 => ['07', '09'], // Jul-Sep
        4 => ['10', '12'], // Okt-Des
    ];

    $start_month = $bulan_range[$angkatan][0];
    $end_month = $bulan_range[$angkatan][1];

    // Filter berdasarkan tgl_daftar menggunakan rentang tanggal
    return $this->select('anggota.*, kelas.nama_kelas')
                ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
                ->where("tgl_daftar >= ", "$tahun-$start_month-01")
                ->where("tgl_daftar <= ", "$tahun-$end_month-31")
                ->orderBy('id_anggota', 'ASC')
                ->findAll();
}

public function generateUniqueAnggotaId(string $tgl_daftar)
{
    $tahun = date('y', strtotime($tgl_daftar));
    $bulan = date('n', strtotime($tgl_daftar)); // Bulan 1-12

    // Periode per 3 bulan: 1 (Jan-Mar), 2 (Apr-Jun), 3 (Jul-Sep), 4 (Okt-Des)
    $periode = ceil($bulan / 3); // <--- INI LOGIKA YANG AKAN KITA GUNAKAN
    $periode_x = str_pad($periode, 2, '0', STR_PAD_LEFT); // Format 01, 02, 03, 04
    
    // Format Prefix: YY.AXX.
    $prefix = $tahun . '.A' . $periode_x . '.'; 
    
    // Cari ID anggota terakhir (Asumsi getLastMemberIdByPeriod sudah benar)
    $lastIdRow = $this->getLastMemberIdByPeriod($tahun, $periode_x);
    $lastId = $lastIdRow['id_anggota'] ?? null;
    
    // ... (Logika penentuan nomor urut tetap sama) ...
    if ($lastId) {
        $lastNumber = (int) substr($lastId, -3); 
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }
    
    $newNumberFormatted = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    
    return $prefix . $newNumberFormatted;
}
// ...
// Tambahkan fungsi ini di dalam class AnggotaModel
public function getAnggotaWithKelasByID($id)
{
    return $this->select('anggota.*, kelas.nama_kelas')
                ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
                ->where('anggota.id_anggota', $id)
                ->first();
}

public function getAnggotaWithKelas($id_user)
{
    return $this->select('anggota.*, kelas.nama_kelas') // Pilih semua kolom anggota dan nama_kelas
                ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left') // Join tabel kelas
                ->where('anggota.id_user', $id_user)
                ->first();
}
public function getAnggotaKelas()
    {

                    return $this->select('anggota.*, kelas.nama_kelas')
                    ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
                    ->where('anggota.status', 'aktif') // tampilkan hanya anggota aktif
                    ->orderBy('kelas.nama_kelas', 'ASC')
                    ->orderBy('anggota.nama', 'ASC')
                    ->findAll();
    }


// Di dalam class AnggotaModel
public function getAllAnggotaWithKelas()
{
    return $this->select('anggota.*, kelas.nama_kelas') // Pilih semua kolom anggota dan nama_kelas
                ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left') // Join tabel kelas
                ->findAll(); // Ambil semua data
}

   
}
