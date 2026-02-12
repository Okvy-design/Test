<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController {
    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {
        $data = [
            'title' => 'Kelola User Pengguna',
            // Hanya menampilkan admin agar tidak bercampur dengan anggota
            'users' => $this->userModel->where('role', 'admin')->findAll()
        ];
        return view('admin/user/index', $data);
    }

    public function save() {
        // Role otomatis diset 'admin' saat simpan
        $this->userModel->save([
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'admin' 
        ]);
        return redirect()->to(base_url('admin/user'))->with('success', 'Admin baru berhasil ditambahkan');
    }

    public function edit($id) {
        $data = [
            'title' => 'Edit Nama Pengguna',
            'user'  => $this->userModel->find($id)
        ];
        return view('admin/user/edit', $data);
    }

    public function update($id) {
        // Hanya mengupdate field 'nama' saja
        $this->userModel->update($id, [
            'nama' => $this->request->getPost('nama')
        ]);
        return redirect()->to(base_url('admin/user'))->with('success', 'Nama pengguna berhasil diubah');
    }

    public function delete($id) {
        $this->userModel->delete($id);
        return redirect()->to(base_url('admin/user'))->with('success', 'User berhasil dihapus');
    }

    public function changePassword() {
        return view('admin/user/change_password', ['title' => 'Ganti Password']);
    }
    
    public function updatePassword() {
        $id = session()->get('id_user');
        $user = $this->userModel->find($id);
        
        $passLama = $this->request->getPost('password_lama');
        $passBaru = $this->request->getPost('password_baru');
        $konfirmasi = $this->request->getPost('konfirmasi_password');
    
        // 1. Cek apakah password lama benar
        if (!password_verify($passLama, $user['password'])) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai!');
        }
    
        // 2. Cek apakah konfirmasi password baru cocok
        if ($passBaru !== $konfirmasi) {
            return redirect()->back()->with('error', 'Konfirmasi password baru tidak cocok!');
        }
    
        // 3. Simpan password baru dengan hashing
        $this->userModel->update($id, [
            'password' => password_hash($passBaru, PASSWORD_DEFAULT)
        ]);
    
        return redirect()->to(base_url('admin/user'))->with('success', 'Password berhasil diperbarui');
    }
}