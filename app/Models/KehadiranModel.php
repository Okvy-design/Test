<?php

namespace App\Models;

use CodeIgniter\Model;

class KehadiranModel extends Model
{
    protected $table      = 'rekap_kehadiran';
    protected $primaryKey = 'id_rekap';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id_rekap',
        'id_detail','tanggal_pertemuan', 'pertemuan_ke',
        'file_pdf','bulan', 'tahun', 'deskripsi'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime'; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function generateIdRekap()
    {
        $tanggal = date('Ymd'); // Hasil: 20251218
        $prefix = "RK" . $tanggal; // Hasil: RK20251218
    
        // Cari ID terakhir yang depannya RK20251218
        $lastId = $this->db->table('rekap_kehadiran')
                           ->select('id_rekap')
                           ->like('id_rekap', $prefix, 'after')
                           ->orderBy('id_rekap', 'DESC')
                           ->limit(1)
                           ->get()
                           ->getRowArray();
    
        if ($lastId) {
            // Ambil 3 angka terakhir (nomor urut) dan tambah 1
            $noUrut = (int) substr($lastId['id_rekap'], -3) + 1;
        } else {
            $noUrut = 1;
        }
    
        // Gabungkan: RK + Tanggal + 3 digit nomor urut (001, 002, dst)
        return $prefix . sprintf("%03s", $noUrut);
    }

    public function getRekapByMonthYear($bulan = null, $tahun = null)
    {
        $builder = $this->db->table($this->table);
        if ($bulan) {
            $builder->where('bulan', $bulan);
        }
        if ($tahun) {
            $builder->where('tahun', $tahun);
        }
        $builder->orderBy('tanggal_pertemuan', 'DESC');
        return $builder->get()->getResultArray();
    }
}