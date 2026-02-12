<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\PelatihModel;

class Kelas extends BaseController
{
    protected $kelasModel;
    protected $pelatihModel;

    public function __construct()
    {
        $this->kelasModel = new KelasModel();
        $this->pelatihModel = new PelatihModel();
    }
    
    /**
     * Fungsi untuk menghasilkan ID Kelas baru (KA001, KD001, ...)
     * Menggunakan prefix K diikuti kode tipe kelas dan nomor urut.
     */
    protected function generateNewKelasId(string $tipeKelas)
    {
        // Tentukan awalan (K + A/D). Ambil A dari 'anak', D dari 'dewasa'
        $char = strtoupper(substr($tipeKelas, 0, 1)); 
        $prefix = 'K' . $char;
        
        // Cari ID kelas terakhir berdasarkan prefix (KAxxx atau KDxxx)
        $last_kelas = $this->kelasModel->select('id_kelas')
                                       ->like('id_kelas', $prefix, 'after') 
                                       ->orderBy('id_kelas', 'DESC')
                                       ->first();

        $next_nnn = 1; // Nomor urut awal
        if ($last_kelas) {
            $lastId = $last_kelas['id_kelas'] ?? null;
            if ($lastId && strlen($lastId) >= 5) { // Pastikan ID memiliki panjang minimal 5
                // Ambil 3 digit terakhir (setelah K + A/D)
                $last_nnn_str = substr($lastId, 2); 
                $last_nnn = (int) $last_nnn_str; 
                $next_nnn = $last_nnn + 1; 
            }
        }
        
        // Format NNN dengan padding nol di depan (e.g., 1 -> 001)
        $nnn_padded = str_pad($next_nnn, 3, '0', STR_PAD_LEFT);
        
        return $prefix . $nnn_padded;
    }

    public function index()
    {
        $data['kelas'] = $this->kelasModel->getKelasWithPelatih();
        return view('admin/kelas/index', $data);
    }

    public function tambah()
    {
        $data['pelatih'] = $this->pelatihModel->findAll();
        return view('admin/kelas/tambah', $data);
    }

    public function simpan()
    {
        $post = $this->request->getPost();
        
        // 1. Ambil tipe kelas dari form POST
        $tipeKelas = $post['tipe_kelas']; 

        // 2. Generate ID berdasarkan tipe kelas yang dipilih
        $newIdKelas = $this->generateNewKelasId($tipeKelas);

        $dataToSave = [
            'id_kelas'         => $newIdKelas,
            'nama_kelas'       => $post['nama_kelas'],
            'tipe_kelas'       => $tipeKelas, // Gunakan nilai dari form
            'rentang_umur_min' => (int)$post['rentang_umur_min'],
            'rentang_umur_max' => (int)$post['rentang_umur_max'],
            'id_pelatih'       => $post['id_pelatih'],
        ];

        // Cek validasi dan simpan
        if (!$this->kelasModel->save($dataToSave)) {
            $errors = $this->kelasModel->errors();
            $errorMessage = "Gagal menyimpan data kelas. Detail error: <ul>";
            foreach ($errors as $error) {
                $errorMessage .= "<li>" . esc($error) . "</li>";
            }
            $errorMessage .= "</ul>";
            
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }

        // Jika berhasil
        return redirect()->to('/admin/kelas')->with('success', 'Kelas ' . esc($post['nama_kelas']) . ' berhasil ditambahkan dengan ID: ' . esc($newIdKelas));
    }

    public function edit($id)
    {
        $data['kelas'] = $this->kelasModel->find($id);
        $data['pelatih'] = $this->pelatihModel->findAll();

        if (!$data['kelas']) {
            return redirect()->to('/admin/kelas')->with('error', 'Data kelas tidak ditemukan.');
        }

        return view('admin/kelas/edit', $data);
    }

    public function update($id)
    {
        $post = $this->request->getPost();
        
        // Ambil tipe kelas dari form POST
        $tipeKelas = $post['tipe_kelas'];
        
        $dataToUpdate = [
            'nama_kelas'       => $post['nama_kelas'],
            'tipe_kelas'       => $tipeKelas, // Pastikan tipe kelas juga terupdate
            'rentang_umur_min' => (int)$post['rentang_umur_min'],
            'rentang_umur_max' => (int)$post['rentang_umur_max'],
            'id_pelatih'       => $post['id_pelatih'],
        ];
        
        if (!$this->kelasModel->update($id, $dataToUpdate)) {
            $errors = $this->kelasModel->errors();
            $errorMessage = "Gagal memperbarui data kelas. Detail error: <ul>";
            foreach ($errors as $error) {
                $errorMessage .= "<li>" . esc($error) . "</li>";
            }
            $errorMessage .= "</ul>";
            
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }

        return redirect()->to('/admin/kelas')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function hapus($id)
    {
        // Tambahkan pengecekan foreign key
        if (!$this->kelasModel->delete($id)) {
            // Cek apakah error disebabkan oleh foreign key constraint (biasanya code != 0)
            if ($this->kelasModel->db()->error()['code'] != 0) {
                 return redirect()->to('/admin/kelas')->with('error', 'Gagal menghapus data. Kemungkinan data ini digunakan di tabel lain (Foreign Key Constraint).');
            }
             return redirect()->to('/admin/kelas')->with('error', 'Data kelas tidak ditemukan.');
        }

        return redirect()->to('/admin/kelas')->with('success', 'Data kelas berhasil dihapus.');
    }
}