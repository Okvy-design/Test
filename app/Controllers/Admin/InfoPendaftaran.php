<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InfoPendaftaranModel; // Import model yang baru dibuat

class InfoPendaftaran extends BaseController
{
    protected $infoModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->infoModel = new InfoPendaftaranModel();
    }

    // Fungsi untuk menampilkan form edit/update data pendaftaran
    public function index()
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');
        
        // Ambil data pertama dari tabel info_pendaftaran (asumsi hanya ada 1 baris aktif)
        $info = $this->infoModel->getActiveInfo(); 
        
        // Jika data belum ada sama sekali, buat objek kosong agar form tidak error
        if (!$info) {
            $info = [
                'id_info' => 'INFO001', // ID default jika tabel kosong
                'judul' => '',
                'deskripsi' => '',
                'langkah_gabung' => '',
                'periode_pendaftaran' => '',
                'tgl_mulai_daftar' => date('Y-m-d'),
                'tgl_akhir_daftar' => date('Y-m-d'),
                'status' => 'aktif',
            ];
            // Catatan: Dalam skenario nyata, mungkin Anda perlu method 'create' 
            // untuk mengisi data awal ini, tetapi untuk kemudahan, kita asumsikan 
            // selalu ada data atau default.
        }

        $data = [
            'title' => 'Kelola Informasi Pendaftaran',
            'info' => $info,
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ];
        
        // Menggunakan view admin/infodaftar/update.php
        return view('admin/infodaftar/update', $data);
    }
    
    // Fungsi untuk memproses pembaruan data
    // Kita akan menggunakan ID INFO yang sama (misal 'INFO001') karena datanya tunggal.
    public function update()
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');
        
        $id_info = $this->request->getPost('id_info');

        // 1. Validasi Input
        if (!$this->validate([
            'judul'                 => 'required|max_length[255]',
            'deskripsi'             => 'required',
            'langkah_gabung'        => 'required',
            'periode_pendaftaran'   => 'required|max_length[100]',
            'tgl_mulai_daftar'      => 'required|valid_date',
            'tgl_akhir_daftar'      => 'required|valid_date',
            'status'                => 'required|in_list[aktif,nonaktif]',
        ])) {
            session()->setFlashdata('validation', $this->validator);
            return redirect()->back()->withInput(); 
        }
        
        // 2. Data Update
        $dataUpdate = [
            'judul'                 => $this->request->getPost('judul'),
            'deskripsi'             => $this->request->getPost('deskripsi'),
            'langkah_gabung'        => $this->request->getPost('langkah_gabung'),
            'periode_pendaftaran'   => $this->request->getPost('periode_pendaftaran'),
            'tgl_mulai_daftar'      => $this->request->getPost('tgl_mulai_daftar'),
            'tgl_akhir_daftar'      => $this->request->getPost('tgl_akhir_daftar'),
            'status'                => $this->request->getPost('status'),
        ];
        
        // 3. Eksekusi Update
        try {
            // Jika ID INFO belum ada di database (kasus pertama kali), lakukan insert
            if (!$this->infoModel->find($id_info)) {
                 $dataUpdate['id_info'] = $id_info; // Tambahkan ID untuk insert
                 $this->infoModel->insert($dataUpdate);
                 session()->setFlashdata('success', 'Informasi Pendaftaran berhasil ditambahkan.');
            } else {
                 // Lakukan update data berdasarkan Primary Key (id_info)
                 $this->infoModel->update($id_info, $dataUpdate);
                 session()->setFlashdata('success', 'Informasi Pendaftaran berhasil diperbarui.');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal memperbarui data. Error: ' . $e->getMessage());
        }

        return redirect()->to(base_url('admin/info-pendaftaran'));
    }
}