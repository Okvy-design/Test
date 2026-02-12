<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KehadiranModel;
use App\Models\DetailKehadiranModel;
use App\Models\AnggotaModel;

class Kehadiran extends BaseController
{
    protected $kehadiranModel;
    protected $detailModel; // Kita pakai nama ini secara konsisten
    protected $anggotaModel;

    public function __construct()
    {
        $this->kehadiranModel = new KehadiranModel();
        $this->detailModel = new DetailKehadiranModel();
        $this->anggotaModel = new AnggotaModel();
        
        // Memuat helper
        helper(['form', 'url', 'mpdf']); 
    }

    public function index()
{
    // Tangkap input dari URL (GET)
    $bulan = $this->request->getGet('bulan') ?? date('m'); 
    $tahun = $this->request->getGet('tahun') ?? date('Y');

    $anggota = $this->anggotaModel->select('anggota.*, kelas.nama_kelas')
        ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
        ->where('anggota.status', 'aktif')
        ->findAll();

    $data = [
        'title'          => 'Data Kehadiran Anggota',
        'anggota'        => $anggota,
        'detailModel'    => $this->detailModel,
        'list_bulan'     => $this->_getListBulan(),
        'list_tahun'     => $this->_getListTahun(),
        'bulan_terpilih' => $bulan, // Kirim kembali ke view untuk status 'selected'
        'tahun_terpilih' => $tahun
    ];

    return view('admin/kehadiran/index', $data);
}
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kehadiran',
            'anggota' => $this->anggotaModel->select('anggota.*, kelas.nama_kelas')
                        ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
                        ->where('anggota.status', 'aktif')
                        ->findAll(),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/kehadiran/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'tanggal_pertemuan' => 'required|valid_date',
            'pertemuan_ke'      => 'required|numeric',
            'anggota_id.*'      => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tanggal      = $this->request->getPost('tanggal_pertemuan');
        $pertemuan_ke = $this->request->getPost('pertemuan_ke');
        $anggotaIds   = $this->request->getPost('anggota_id');
        $kelasIds     = $this->request->getPost('kelas_id');
        $statuses     = $this->request->getPost('status');
        $keterangans  = $this->request->getPost('keterangan');

        // Gunakan Transaksi Database agar aman (jika satu gagal, semua batal)
        $db = \Config\Database::connect();
        $db->transStart();

        $idRekapBaru = $this->kehadiranModel->generateIdRekap();

        // 1. Simpan Header Rekap (KehadiranModel)
        $this->kehadiranModel->insert([
            'id_rekap'          => $idRekapBaru,
            'tanggal_pertemuan' => $tanggal,
            'pertemuan_ke'      => $pertemuan_ke,
            'bulan'             => date('m', strtotime($tanggal)), // Simpan '01' bukan '1'
            'tahun'             => date('Y', strtotime($tanggal)),
            'deskripsi'         => "Pertemuan Ke-" . $pertemuan_ke,
        ]);

        // 2. Simpan Detail (DetailKehadiranModel)
        foreach ($anggotaIds as $key => $id_anggota) {
            $this->detailModel->insert([
                'id_detail'        => $this->detailModel->generateIdDetail(),
                'id_rekap'         => $idRekapBaru,
                'id_anggota'       => $id_anggota,
                'id_kelas'         => $kelasIds[$key],
                'status_kehadiran' => $statuses[$key], // PERBAIKAN: Sesuaikan dengan kolom tabel kamu
                'keterangan'       => $keterangans[$key],
                'tanggal_pertemuan'=> $tanggal // Sesuai info tabel kamu tadi
            ]);
        }

        $db->transComplete();

        return redirect()->to(base_url('admin/kehadiran'))->with('success', 'Data berhasil disimpan.');
    }

    public function detail($id_anggota)
{
    $bulan = $this->request->getGet('bulan');
    $tahun = $this->request->getGet('tahun');

    $anggota = $this->anggotaModel->select('anggota.*, kelas.nama_kelas')
        ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
        ->find($id_anggota);

    if (!$anggota) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $builder = $this->detailModel->where('id_anggota', $id_anggota);

    // Tambahkan filter jika admin memilih bulan/tahun di halaman detail
    if ($bulan) $builder->where("MONTH(tanggal_pertemuan)", $bulan);
    if ($tahun) $builder->where("YEAR(tanggal_pertemuan)", $tahun);

    $details = $builder->orderBy('tanggal_pertemuan', 'DESC')->findAll();

    $data = [
        'title'          => 'Detail Kehadiran: ' . $anggota['nama'],
        'anggota'        => $anggota,
        'details'        => $details,
        'list_bulan'     => $this->_getListBulan(),
        'list_tahun'     => $this->_getListTahun(),
        'bulan_terpilih' => $bulan,
        'tahun_terpilih' => $tahun
    ];

    return view('admin/kehadiran/detail', $data);
}
    // Helper methods pribadi
    private function _getListBulan() {
        return [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', 
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', 
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
    }

    private function _getListTahun() {
        $years = [];
        for ($i = 0; $i < 5; $i++) { $years[] = date('Y') - $i; }
        return $years;
    }
}