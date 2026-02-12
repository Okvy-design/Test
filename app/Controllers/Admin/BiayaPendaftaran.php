<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BiayaPendaftaranModel;

class BiayaPendaftaran extends BaseController
{
    protected $biayaModel;
    protected $helpers = ['form', 'url'];
    
    public function __construct()
    {
        $this->biayaModel = new BiayaPendaftaranModel();
    }

    // Fungsi internal untuk generate ID (Tetap dipertahankan)
    private function _generateNewId(?string $lastId, string $prefix = 'BYA'): string
    {
        if (empty($lastId)) {
            return $prefix . '001';
        }
        $number = (int)substr($lastId, strlen($prefix));
        $newNumber = $number + 1;
        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $dataBiaya = $this->biayaModel->findAll();
        
        // Inisialisasi data default jika tabel kosong
        if (empty($dataBiaya)) {
            $lastId = $this->biayaModel->_getLastId();
            
            $newId1 = $this->_generateNewId($lastId);
            $this->biayaModel->insert([
                'id_biaya' => $newId1,
                'jenis_biaya' => 'Pendaftaran',
                'jumlah' => 0.00,
                'keterangan' => 'Biaya pendaftaran (dibayar di awal)',
            ]);
            
            $newId2 = $this->_generateNewId($newId1);
            $this->biayaModel->insert([
                'id_biaya' => $newId2,
                'jenis_biaya' => 'Iuran Bulanan',
                'jumlah' => 0.00,
                'keterangan' => 'Biaya iuran bulanan',
            ]);
            $dataBiaya = $this->biayaModel->findAll();
        }
        
        $data = [
            'title' => 'Manajemen Biaya Pendaftaran',
            'biaya' => $dataBiaya,
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ];
        return view('admin/biaya/index', $data);
    }

    /**
     * FUNGSI BARU: Tambah Jenis Biaya Baru
     */
    public function add()
    {
        // Ambil ID terakhir dari database untuk generate ID baru
        $lastIdRow = $this->biayaModel->orderBy('id_biaya', 'DESC')->first();
        $lastId = $lastIdRow ? $lastIdRow['id_biaya'] : null;
        $newId = $this->_generateNewId($lastId);

        $this->biayaModel->insert([
            'id_biaya'    => $newId,
            'jenis_biaya' => $this->request->getPost('jenis_biaya'),
            'jumlah'      => $this->request->getPost('jumlah'),
            'keterangan'  => $this->request->getPost('keterangan'),
        ]);

        session()->setFlashdata('success', 'Jenis biaya baru berhasil ditambahkan.');
        return redirect()->to(base_url('admin/biaya'));
    }

    /**
     * FUNGSI UPDATE: Diperbarui agar bisa edit Nama Jenis Biaya juga
     */
    public function update()
    {
        if (!$this->validate([
            'biaya.*.jumlah' => 'required|numeric|greater_than_equal_to[0]',
            'biaya.*.jenis_biaya' => 'required',
        ])) {
            session()->setFlashdata('validation', $this->validator);
            return redirect()->back()->withInput();
        }
        
        $dataPost = $this->request->getPost('biaya');
        
        if ($dataPost) {
            foreach ($dataPost as $id_biaya => $item) {
                $this->biayaModel->update($id_biaya, [
                    'jenis_biaya' => $item['jenis_biaya'], // Sekarang nama jenis bisa diedit
                    'jumlah'      => $item['jumlah'],
                    'keterangan'  => $item['keterangan'],
                ]);
            }
        }
        
        session()->setFlashdata('success', 'Data biaya berhasil diperbarui.');
        return redirect()->to(base_url('admin/biaya'));
    }

    /**
     * FUNGSI BARU: Hapus Jenis Biaya
     */
    public function delete($id)
    {
        $this->biayaModel->delete($id);
        session()->setFlashdata('success', 'Jenis biaya berhasil dihapus.');
        return redirect()->to(base_url('admin/biaya'));
    }
}