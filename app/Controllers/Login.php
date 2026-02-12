<?php

namespace App\Controllers;

use App\Models\UserModel; 
use App\Models\AnggotaModel;

class Login extends BaseController 
{
    public function index()
    {
        return view('login'); 
    }

    public function auth()
{
    $session = session();
    $model = new UserModel();
    $anggotaModel = new AnggotaModel(); // Tambahkan model anggota

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Cari user di tabel 'user' berdasarkan username
    $user = $model->where('username', $username)->first();

    if ($user) {
        // 1. Verifikasi Password
        if (password_verify($password, $user['password'])) {
            
            // 2. Siapkan data Session Dasar
            $session_data = [
                'id_user'   => $user['id_user'],
                'nama'      => $user['nama'],
                'role'      => $user['role'],
                'logged_in' => true
            ];

            // 3. JIKA ROLE ADALAH ANGGOTA, ambil id_anggota dari tabel anggota
            if ($user['role'] === 'anggota') {
                // Cari data anggota yang memiliki id_user yang sama dengan user yang login
                $dataAnggota = $anggotaModel->where('id_user', $user['id_user'])->first();
                
                if ($dataAnggota) {
                    // Simpan id_anggota ke session agar bisa dipakai di menu kehadiran
                    $session_data['id_anggota'] = $dataAnggota['id_anggota'];
                } else {
                    // Jika user punya role anggota tapi tidak ada datanya di tabel anggota
                    return redirect()->back()->with('error', 'Data profil anggota tidak ditemukan!');
                }
            }

            // Simpan semua data ke session
            $session->set($session_data);

            // 4. Pengalihan (Redirect) berdasarkan Role
            if ($user['role'] === 'admin') {
                return redirect()->to(base_url('admin/dashboard'));
            } else {
                return redirect()->to(base_url('anggota/dashboard'));
            }
            
        } else {
            return redirect()->back()->with('error', 'Password salah!');
        }
    } else {
        return redirect()->back()->with('error', 'Username tidak ditemukan!');
    }
}

    public function logout()
    {
        // Logout ini melayani semua role (anggota dan admin)
        session()->destroy();
        
        // Arahkan ke halaman login yang terpadu
        return redirect()->to(base_url('login')); 
    }
}