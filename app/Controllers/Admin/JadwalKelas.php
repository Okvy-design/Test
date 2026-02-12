<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JadwalKelasModel;
use App\Models\KelasModel; 
use CodeIgniter\Validation\Validation; // Tambahkan ini

class JadwalKelas extends BaseController
{
    protected $jadwalModel;
    protected $kelasModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->jadwalModel = new JadwalKelasModel();
        $this->kelasModel = new KelasModel();
    }
    
    // Fungsi untuk menghasilkan ID baru (JK001, JK002, dst.)
    private function _generateNewId(?string $lastId, string $prefix = 'JK'): string
    {
        if (empty($lastId)) {
            return $prefix . '001';
        }
        $number = (int)substr($lastId, strlen($prefix));
        $newNumber = $number + 1;
        // Pastikan angka selalu 3 digit (001, 010, 100)
        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT); 
    }

    public function index()
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');
        
        $data = [
            'title' => 'Manajemen Jadwal Kelas',
            'jadwal' => $this->jadwalModel->getJadwalDenganKelas(), 
        ];
        return view('admin/jadwal-sanggar/index', $data);
    }

    public function create()
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');
        
        $lastId = $this->jadwalModel->_getLastId(); 
        
        $data = [
            'title' => 'Tambah Jadwal Kelas Baru',
            'kelas' => $this->kelasModel->findAll(), 
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'new_id' => $this->_generateNewId($lastId), 
        ];
        return view('admin/jadwal-sanggar/create', $data);
    }

    public function store()
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');

        // Validasi
        if (!$this->validate([
            'id_kelas'  => 'required',
            'hari'      => 'required',
            'waktu'     => 'required',
            'tipe_sesi' => 'required',
        ])) {
            session()->setFlashdata('validation', $this->validator);
            return redirect()->back()->withInput();
        }

        // Generate ID baru sebelum insert
        $lastId = $this->jadwalModel->_getLastId();
        $newId = $this->_generateNewId($lastId);
        
        $this->jadwalModel->insert([
            'id_jadwal' => $newId,
            'id_kelas'  => $this->request->getPost('id_kelas'),
            'hari'      => $this->request->getPost('hari'),
            'waktu'     => $this->request->getPost('waktu'),
            'tipe_sesi' => $this->request->getPost('tipe_sesi'),
        ]);

        session()->setFlashdata('success', 'Data jadwal berhasil ditambahkan dengan ID: ' . $newId);
        return redirect()->to(base_url('admin/jadwal-sanggar'));
    }
    
    public function edit($id_jadwal)
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');

        $jadwal = $this->jadwalModel->find($id_jadwal);
        
        if (!$jadwal) {
            session()->setFlashdata('error', 'Data Jadwal tidak ditemukan.');
            return redirect()->to(base_url('admin/jadwal-sanggar'));
        }
        
        $data = [
            'title'      => 'Edit Jadwal Kelas: ' . esc($id_jadwal),
            'jadwal'     => $jadwal,
            'kelas'      => $this->kelasModel->findAll(),
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ];
        
        return view('admin/jadwal-sanggar/edit', $data);
    }

    public function update($id_jadwal)
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');

        // 2. Validasi Input
        if (!$this->validate([
            'id_kelas'  => 'required',
            'hari'      => 'required',
            'waktu'     => 'required',
            'tipe_sesi' => 'required',
        ])) {
            session()->setFlashdata('validation', $this->validator);
            // Kembali ke halaman edit dengan ID yang sama
            return redirect()->back()->withInput(); 
        }
        
        // 3. Update Data
        $dataUpdate = [
            'id_kelas'  => $this->request->getPost('id_kelas'),
            'hari'      => $this->request->getPost('hari'),
            'waktu'     => $this->request->getPost('waktu'),
            'tipe_sesi' => $this->request->getPost('tipe_sesi'),
        ];
        
        try {
             // Method update akan mencari baris berdasarkan $id_jadwal (Primary Key)
            $this->jadwalModel->update($id_jadwal, $dataUpdate);
            session()->setFlashdata('success', 'Data jadwal ID ' . esc($id_jadwal) . ' berhasil diperbarui.');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal memperbarui data. Error: ' . $e->getMessage());
        }

        return redirect()->to(base_url('admin/jadwal-sanggar'));
    }

    public function delete($id_jadwal) 
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');
    
        try {
            $jadwalData = $this->jadwalModel->find($id_jadwal); 
            
            if ($jadwalData) {
                $hapus = $this->jadwalModel->delete($id_jadwal);
                
                if ($hapus) {
                    session()->setFlashdata('success', 'Jadwal Kelas ID ' . esc($id_jadwal) . ' berhasil dihapus.');
                } else {
                    session()->setFlashdata('error', 'Gagal menghapus jadwal. Operasi database gagal.');
                }
            } else {
                 session()->setFlashdata('error', 'Jadwal Kelas ID ' . esc($id_jadwal) . ' tidak ditemukan.');
            }
    
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan sistem saat menghapus. Error: ' . $e->getMessage());
            log_message('error', 'Jadwal Kelas Delete Exception: ' . $e->getMessage());
        }
    
        return redirect()->to(base_url('admin/jadwal-sanggar'));
    }
}