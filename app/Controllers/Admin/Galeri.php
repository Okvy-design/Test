<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriModel;

class Galeri extends BaseController
{
    protected $galeriModel;

    public function __construct() {
        $this->galeriModel = new GaleriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Galeri',
            'galeri' => $this->galeriModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/galeri/index', $data);
    }

    public function update()
{
    $id = $this->request->getPost('id_galeri');
    
    $this->galeriModel->update($id, [
        'judul'     => $this->request->getPost('judul'),
        'kategori'  => $this->request->getPost('kategori'),
        'deskripsi' => $this->request->getPost('deskripsi'),
    ]);

    return redirect()->to('/admin/galeri')->with('success', 'Data galeri berhasil diperbarui.');
}

    public function save()
    {
        // Validasi input
        if (!$this->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
        ])) {
            return redirect()->back()->withInput();
        }

        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('assets/images/galeri', $namaGambar);

        $newID = $this->galeriModel->generateID();

       $this->galeriModel->save([
        'id_galeri' => $newID, // Simpan dengan ID buatan (IMGxxx)
        'judul'     => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'kategori'  => $this->request->getPost('kategori'),
        'gambar'    => $namaGambar
    ]);

        return redirect()->to('/admin/galeri')->with('success', "Foto berhasil ditambahkan dengan ID $newID.");
    }

    public function delete($id)
    {
        $data = $this->galeriModel->find($id);
        
        // Logika Minimal 3 Foto per Kategori
        $count = $this->galeriModel->where('kategori', $data['kategori'])->countAllResults();
        
        if ($count <= 3) {
            return redirect()->to('/admin/galeri')->with('error', 'Gagal menghapus. Minimal harus ada 3 foto dalam kategori ' . $data['kategori'] . ' agar tampilan web tetap rapi.');
        }

        unlink('assets/images/galeri/' . $data['gambar']);
        $this->galeriModel->delete($id);

        return redirect()->to('/admin/galeri')->with('success', 'Foto berhasil dihapus.');
    }
}