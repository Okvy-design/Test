<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\PelatihModel;

class Pelatih extends BaseController
{
    protected $pelatihModel;

    public function __construct()
    {
        $this->pelatihModel = new PelatihModel();
    }

    /**
     * Fungsi untuk menghasilkan ID Pelatih baru (PA001, PA002, ...)
     */
    protected function generateNewPelatihId()
    {
        // Catatan: getLastPelatihId() mengembalikan array ['id_pelatih' => 'PAxxx']
        $last_pelatih = $this->pelatihModel->getLastPelatihId();

        $next_nnn = 1; // Nomor urut awal
        if ($last_pelatih) {
            // Pastikan kunci array ada sebelum diakses
            $lastId = $last_pelatih['id_pelatih'] ?? null;
            if ($lastId) {
                // Asumsi format: PA001. Ambil 3 digit terakhir (001)
                $last_nnn_str = substr($lastId, 2); // Ambil '001'
                $last_nnn = (int) $last_nnn_str; 
                $next_nnn = $last_nnn + 1; // Tambah 1
            }
        }

        // Format NNN dengan padding nol di depan (e.g., 1 -> 001)
        $nnn_padded = str_pad($next_nnn, 3, '0', STR_PAD_LEFT);
        
        // Susun ID Pelatih Baru: PA + NNN
        return 'PA' . $nnn_padded;
    }

    public function index()
    {
        $data['title'] = 'Data Pelatih';
        $data['pelatih'] = $this->pelatihModel->findAll();
        return view('admin/pelatih/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Pelatih';
        // Kirim ID Pelatih yang otomatis dibuat ke view
        $data['id_pelatih_otomatis'] = $this->generateNewPelatihId();
        return view('admin/pelatih/tambah', $data);
    }

    public function simpan()
    {
        $post = $this->request->getPost();

        // 1. Logika Generate ID
        // Hapus penulisan ID yang tidak diperlukan jika sudah ada di form tambah, 
        // tapi biarkan sebagai fallback
        if (empty($post['id_pelatih'])) {
            $post['id_pelatih'] = $this->generateNewPelatihId();
        }

        $dataToSave = [
            'id_pelatih' => $post['id_pelatih'],
            'nama'       => $post['nama'],
            'no_hp'      => $post['no_hp'],
            'alamat'     => $post['alamat'],
        ];

        // 2. Coba simpan dan TANGANI KEGAGALAN DARI VALIDASI MODEL
        if (!$this->pelatihModel->save($dataToSave)) {
            
            $errors = $this->pelatihModel->errors();
            
            // Format pesan error HTML
            $errorMessage = "Gagal menyimpan data pelatih. Detail error: <ul>";
            foreach ($errors as $error) {
                $errorMessage .= "<li>" . esc($error) . "</li>";
            }
            $errorMessage .= "</ul>";

            // Redirect kembali ke form tambah dengan input lama dan pesan error
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
        
        // 3. Jika berhasil
        return redirect()->to('/admin/pelatih')->with('success', 'Pelatih ' . esc($post['nama']) . ' berhasil ditambahkan dengan ID: ' . esc($post['id_pelatih']));
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Pelatih';
        $data['pelatih'] = $this->pelatihModel->find($id);

        if (!$data['pelatih']) {
            return redirect()->to('/admin/pelatih')->with('error', 'Data pelatih tidak ditemukan.');
        }

        return view('admin/pelatih/edit', $data);
    }

    public function update($id)
    {
        $dataToUpdate = [
            'nama' => $this->request->getPost('nama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        
        // Perbaikan: Lakukan penanganan error saat update
        if (!$this->pelatihModel->update($id, $dataToUpdate)) {
            
            $errors = $this->pelatihModel->errors();
            
            $errorMessage = "Gagal memperbarui data pelatih. Detail error: <ul>";
            foreach ($errors as $error) {
                $errorMessage .= "<li>" . esc($error) . "</li>";
            }
            $errorMessage .= "</ul>";

            // Redirect kembali ke form edit dengan input lama dan pesan error
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }

        return redirect()->to('/admin/pelatih')->with('success', 'Data pelatih berhasil diperbarui.');
    }

    public function hapus($id)
    {
        // Lakukan pengecekan sebelum hapus
        if (!$this->pelatihModel->find($id)) {
             return redirect()->to('/admin/pelatih')->with('error', 'Data pelatih tidak ditemukan.');
        }
        
        $this->pelatihModel->delete($id);
        
        // Cek apakah ada error saat delete (misalnya, foreign key constraint)
        if ($this->pelatihModel->db()->error()['code'] != 0) {
            return redirect()->to('/admin/pelatih')->with('error', 'Gagal menghapus data. Kemungkinan data ini digunakan di tabel lain.');
        }

        return redirect()->to('/admin/pelatih')->with('success', 'Data pelatih berhasil dihapus.');
    }
}