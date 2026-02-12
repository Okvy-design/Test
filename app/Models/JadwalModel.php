<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $allowedFields = ['nama_kelas', 'rentang_umur_min', 'rentang_umur_max', 'id_pelatih'];

    // Ambil daftar kelas + pelatih + jumlah anggota otomatis berdasarkan rentang umur
    public function getJadwal()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kelas');
        $builder->select('kelas.*, pelatih.nama as nama_pelatih');
        $builder->join('pelatih', 'pelatih.id_pelatih = kelas.id_pelatih', 'left');
        $kelasList = $builder->get()->getResultArray();

        // Tambahkan jumlah anggota otomatis per kelas
        foreach ($kelasList as &$kelas) {
            $count = $db->table('anggota')
                ->where('id_kelas', $kelas['id_kelas']) // <-- PERBAIKAN: Filter berdasarkan ID Kelas!
                ->countAllResults();
            $kelas['jumlah_anggota'] = $count;
        }

        return $kelasList;
    }

    // Ambil daftar anggota berdasarkan umur dan kelas tertentu
    public function getAnggotaByKelas($kelas)
    {
        $db = \Config\Database::connect();
        return $db->table('anggota')
            ->where('id_kelas', $kelas['id_kelas'])
            // ->where('umur >=', $kelas['rentang_umur_min'])
            // ->where('umur <=', $kelas['rentang_umur_max'])
            ->get()
            ->getResultArray();
    }

    public function getKelasWithPelatih($id_kelas)
    {
        return $this->db->table('kelas')
            ->select('kelas.*, pelatih.nama AS nama_pelatih')
            ->join('pelatih', 'pelatih.id_pelatih = kelas.id_pelatih')
            ->where('kelas.id_kelas', $id_kelas)
            ->get()
            ->getRowArray();
    }
    

}
