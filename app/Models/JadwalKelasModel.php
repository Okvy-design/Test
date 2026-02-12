<?php namespace App\Models;

use CodeIgniter\Model;

class JadwalKelasModel extends Model
{
    protected $table      = 'jadwal_kelas';
    protected $primaryKey = 'id_jadwal'; 
    protected $allowedFields = ['id_jadwal','id_kelas', 'hari', 'waktu', 'tipe_sesi'];
    protected $useTimestamps = true; 

    // Fungsi untuk mengambil data jadwal sekaligus dengan nama kelasnya (JOIN)
    public function getJadwalDenganKelas()
    {
        return $this->db->table('jadwal_kelas')
        ->select('jadwal_kelas.*, kelas.nama_kelas, kelas.tipe_kelas')
        ->join('kelas', 'kelas.id_kelas = jadwal_kelas.id_kelas')
        ->orderBy('kelas.tipe_kelas', 'ASC')
        ->get()
        ->getResultArray();
    }

    
    public function _getLastId()
    {
        // Menggunakan SELECT MAX() untuk memastikan mendapatkan nilai tertinggi, 
        // yang secara leksikal akan menjadi ID terakhir (misal: JK015 > JK009)
        $row = $this->selectMax('id_jadwal', 'max_id')
                    ->get()
                    ->getRowArray();
        
        return $row['max_id'] ?? null; // Kembalikan nilai ID tertinggi, atau null jika tabel kosong
    }
}