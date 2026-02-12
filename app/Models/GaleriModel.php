<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table            = 'galeri';
    protected $primaryKey       = 'id_galeri';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['judul', 'deskripsi', 'gambar', 'kategori'];

    public function generateID()
    {
        // Ambil ID terakhir
        $builder = $this->db->table($this->table);
        $builder->selectMax('id_galeri');
        $query = $builder->get()->getRowArray();

        $lastID = $query['id_galeri']; // Hasilnya misal IMG002

        if (!$lastID) {
            return 'IMG001';
        }

        // Ambil angka dari string IMG002 -> 002
        $number = (int) substr($lastID, 3);
        $nextNumber = $number + 1;

        // Gabungkan kembali menjadi IMG + angka dengan padding nol (3 digit)
        return 'IMG' . sprintf('%03d', $nextNumber);
    }
}