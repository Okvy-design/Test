<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailKehadiranModel extends Model
{
    protected $table      = 'detail_kehadiran';
    protected $primaryKey = 'id_detail';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id_rekap', 
        'id_detail',
        'id_anggota', 
        'id_kelas', 
        'tanggal_pertemuan',
        'status_kehadiran', 
        'keterangan'
    ];
    protected $useTimestamps = false; 

    

    public function generateIdDetail()
{
    $tanggal = date('Ymd');
    $prefix = "DK" . $tanggal;

    $lastId = $this->db->table('detail_kehadiran')
                       ->select('id_detail')
                       ->like('id_detail', $prefix, 'after')
                       ->orderBy('id_detail', 'DESC')
                       ->limit(1)
                       ->get()
                       ->getRowArray();

    if ($lastId) {
        $noUrut = (int) substr($lastId['id_detail'], -3) + 1;
    } else {
        $noUrut = 1;
    }

    return $prefix . sprintf("%03s", $noUrut);
}


public function getRekapPerAnggota($id_anggota, $bulan = null, $tahun = null)
{
    // Query untuk Hadir
    $hadirBuilder = $this->db->table($this->table)
        ->where('id_anggota', $id_anggota)
        ->where('status_kehadiran', 'hadir');

    // Query untuk Tidak Hadir (Sakit, Izin, Tanpa Keterangan)
    $tidakHadirBuilder = $this->db->table($this->table)
        ->where('id_anggota', $id_anggota)
        ->whereIn('status_kehadiran', ['sakit', 'izin', 'tidak hadir']);

    // Terapkan filter Tanggal jika ada
    if ($bulan) {
        // Casting ke integer agar '01' menjadi 1 sesuai output MONTH() SQL
        $hadirBuilder->where("MONTH(tanggal_pertemuan)", (int)$bulan);
        $tidakHadirBuilder->where("MONTH(tanggal_pertemuan)", (int)$bulan);
    }
    if ($tahun) {
        $hadirBuilder->where("YEAR(tanggal_pertemuan)", $tahun);
        $tidakHadirBuilder->where("YEAR(tanggal_pertemuan)", $tahun);
    }

    return [
        'total_hadir'       => $hadirBuilder->countAllResults(),
        'total_tidak_hadir' => $tidakHadirBuilder->countAllResults()
    ];
}
   
    public function getDetailWithAnggotaKelas($id_rekap)
    {
        return $this->db->table($this->table)
            ->select('detail_kehadiran.*, anggota.nama, kelas.nama_kelas')
            ->join('anggota', 'anggota.id_anggota = detail_kehadiran.id_anggota')
            // Pastikan join kelas menggunakan id_kelas dari tabel detail_kehadiran
            ->join('kelas', 'kelas.id_kelas = detail_kehadiran.id_kelas', 'left') 
            ->where('detail_kehadiran.id_rekap', $id_rekap)
            ->get()
            ->getResultArray();
    }

}
