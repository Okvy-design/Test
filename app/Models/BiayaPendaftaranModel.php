<?php namespace App\Models;

use CodeIgniter\Model;

class BiayaPendaftaranModel extends Model
{
    protected $table      = 'biaya_pendaftaran';
    protected $primaryKey = 'id_biaya'; 
    protected $allowedFields = ['id_biaya', 'jenis_biaya', 'jumlah', 'keterangan'];
    protected $useTimestamps = true; 
    
    // Fungsi bantuan untuk mendapatkan ID terakhir
    public function _getLastId()
    {
        return $this->select($this->primaryKey)
                    ->orderBy($this->primaryKey, 'DESC')
                    ->limit(1)
                    ->get()
                    ->getRowArray()[$this->primaryKey] ?? null;
    }
}