<?php

namespace App\Models;
use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $useAutoIncrement = false; 
    protected $allowedFields = ['id_kelas', 'nama_kelas', 'tipe_kelas','rentang_umur_min','rentang_umur_max', 'id_pelatih'];

    // --- TAMBAHKAN VALIDASI UNTUK KEAMANAN DAN KEBERHASILAN SAVE ---
    protected $validationRules = [
        'nama_kelas'       => 'required|max_length[100]',
        'tipe_kelas'       => 'required|in_list[anak,dewasa]', // Memastikan tipe_kelas valid
        'rentang_umur_min' => 'required|integer|less_than_equal_to[rentang_umur_max]',
        'rentang_umur_max' => 'required|integer',
        'id_pelatih'       => 'required|max_length[5]',
    ];
    
    protected $validationMessages = [
        'rentang_umur_min' => [
            'less_than_equal_to' => 'Rentang umur min harus lebih kecil atau sama dengan rentang umur max.'
        ],
        'tipe_kelas' => [
            'in_list' => 'Tipe kelas harus diisi dengan "anak" atau "dewasa".'
        ]
    ];
    // --- AKHIR VALIDASI ---

    public function getKelasWithPelatih()
    {
        return $this->select('kelas.*, pelatih.nama as nama_pelatih')
                    ->join('pelatih', 'pelatih.id_pelatih = kelas.id_pelatih')
                    ->findAll();
    }

    public function findKelasByUmur(int $umurAnggota)
    {
        $kelas = $this->where('rentang_umur_min <=', $umurAnggota)
                      ->where('rentang_umur_max >=', $umurAnggota)
                      ->first();

        return $kelas['id_kelas'] ?? null;
    }
}