<?php

namespace App\Controllers\Anggota;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AnggotaModel;

class Password extends BaseController
{
    protected $userModel;
    protected $anggotaModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        $id_user = session()->get('id_user');
        
        // Cek jika session kosong (belum login)
        if (!$id_user) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title'   => 'Ganti Password',
            'content' => 'anggota/ganti_password',
            'anggota' => $this->anggotaModel->getAnggotaWithKelas($id_user)
        ];

        return view('anggota/layout/wrapper', $data);
    }

    public function update()
    {
        $id_user = session()->get('id_user');
        $user = $this->userModel->find($id_user);

        $pass_lama = $this->request->getPost('password_lama');
        $pass_baru = $this->request->getPost('password_baru');
        $konf_pass = $this->request->getPost('konfirmasi_password');

        // Validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'password_baru' => 'required|min_length[8]',
            'konfirmasi_password' => 'matches[password_baru]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', 'Password baru minimal 8 karakter dan harus cocok dengan konfirmasi.');
        }

        // Verifikasi Password Lama
        if (!password_verify((string)$pass_lama, $user['password'])) {
            return redirect()->back()->with('error', 'Password lama Anda salah!');
        }

        // Eksekusi Update
        $this->userModel->update($id_user, [
            'password' => password_hash((string)$pass_baru, PASSWORD_DEFAULT)
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }
}