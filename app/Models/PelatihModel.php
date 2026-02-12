<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihModel extends Model
{
    protected $table = 'pelatih';
    protected $primaryKey = 'id_pelatih';
    protected $useAutoIncrement = false; // <-- TAMBAHKAN INI!
    protected $allowedFields = [
        'id_pelatih', 
        'nama',
        'no_hp',
        'alamat',
    ];
    protected $validationRules = [
        'id_pelatih' => 'required|is_unique[pelatih.id_pelatih]|max_length[5]', // PA001
        'nama'       => 'required|min_length[3]|max_length[100]',
        'alamat'     => 'required|min_length[5]|max_length[100]',
        'no_hp'      => 'required|max_length[15]|numeric',
    ];
    protected $validationMessages = [
        'id_pelatih' => [
            'required'   => 'ID Pelatih harus diisi.',
            'is_unique'  => 'ID Pelatih sudah terdaftar.',
            'max_length' => 'ID Pelatih maksimal 5 karakter.',
        ],
        'nama' => [
            'required'   => 'Nama harus diisi.',
            'min_length' => 'Nama minimal 3 karakter.',
            'max_length' => 'Nama maksimal 100 karakter.',
        ],
        'alamat' => [
            'required'   => 'Alamat harus diisi.',
            'min_length' => 'Alamat minimal 5 karakter.',
        ],
        'no_hp' => [
            'required'   => 'Nomor HP harus diisi.',
            'max_length' => 'Nomor HP maksimal 15 digit.',
            'numeric'    => 'Nomor HP hanya boleh berisi angka.',
        ],
    ];

    public function getLastPelatihId()
    {
        $prefix = 'PA';
        
        // Cari ID pelatih yang dimulai dengan PA, lalu urutkan DESC untuk mendapatkan yang terbesar
        return $this->select('id_pelatih')
                    ->like('id_pelatih', $prefix, 'after') 
                    ->orderBy('id_pelatih', 'DESC')
                    ->first();
    }
}