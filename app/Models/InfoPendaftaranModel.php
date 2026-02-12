<?php namespace App\Models;

use CodeIgniter\Model;

class InfoPendaftaranModel extends Model
{
    protected $table          = 'info_pendaftaran';
    protected $primaryKey     = 'id_info';
    protected $allowedFields  = ['id_info', 'judul', 'deskripsi', 'langkah_gabung', 'periode_pendaftaran', 'tgl_mulai_daftar', 'tgl_akhir_daftar', 'status'];
    protected $useTimestamps  = true; 
    protected $dateFormat     = 'datetime';
    
    // Fungsi untuk mendapatkan data pendaftaran yang sedang aktif
    public function getActiveInfo()
    {
        return $this->where('status', 'aktif')
                    ->orderBy('tgl_akhir_daftar', 'DESC') // Ambil yang paling baru jika ada beberapa yang aktif
                    ->first();
    }
}