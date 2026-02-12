<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AnggotaModel; 

class Register extends BaseController
{
    public function index()
    {
        return view('registrasi_anggota'); 
    }

    public function simpan()
    {
        $userModel = new UserModel();
        $anggotaModel = new AnggotaModel();
        
        // 1. Validasi Input
        if (!$this->validate([
            'nama' => 'required|min_length[3]|max_length[100]',
            'username' => 'required|min_length[5]|is_unique[user.username]',
            'password' => 'required|min_length[8]',
            'pass_confirm' => 'required|matches[password]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Simpan Data ke Tabel 'user'
        $data_user = [
            'nama'      => $this->request->getPost('nama'),
            'username'  => $this->request->getPost('username'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // HARUS DI-HASH!
            'role'      => 'anggota', // Tetapkan sebagai anggota
            // Kolom 'email' mungkin perlu ditambahkan di tabel user
        ];
        $userModel->insert($data_user);
        $new_id_user = $userModel->insertID(); // Ambil ID yang baru dibuat

        // 3. Simpan Data Awal ke Tabel 'anggota'
        // Data yang dimasukkan hanya data dasar, sisanya diisi di portal anggota
        $data_anggota = [
            'id_user'       => $new_id_user,
            'nama'          => $this->request->getPost('nama'),
            'tgl_daftar'    => date('Y-m-d'),
            'status'        => 'tidak-aktif', // Status awal: menunggu kelengkapan profil
            // Kolom id_anggota unik bisa di-generate di sini, atau nanti saat profil dilengkapi
        ];
        $anggotaModel->insert($data_anggota);

        // 4. Redirect ke halaman Login atau Langsung ke Dashboard (Opsional)
        return redirect()->to(base_url('login'))->with('success', 'Registrasi berhasil! Silakan login untuk melengkapi data profil.');
    }
}