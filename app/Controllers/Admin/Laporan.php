<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\KehadiranModel;
use App\Models\DetailKehadiranModel;
use App\Models\AnggotaModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Laporan extends BaseController
{
    protected $kehadiranModel;
    protected $detailModel;
    protected $anggotaModel;

    public function __construct()
    {
        $this->kehadiranModel = new KehadiranModel();
        $this->detailModel = new DetailKehadiranModel();
        $this->anggotaModel = new AnggotaModel();
    }

    public function anggota()
    {
        $data = [
            'title' => 'Laporan Data Anggota',
            'list_tahun' => range(date('Y'), date('Y') - 5),
        ];
        return view('admin/laporan/anggota/index', $data);
    }

    public function cetak_anggota()
{
    $angkatan = $this->request->getPost('angkatan');
    $tahun    = $this->request->getPost('tahun');
    $admin_nama = session()->get('nama'); // Ambil nama admin dari session

    $laporan = $this->anggotaModel->getAnggotaByAngkatan($angkatan, $tahun);

    $data = [
        'title'    => "REKAP DATA ANGGOTA ANGKATAN $angkatan TAHUN $tahun",
        'angkatan' => $angkatan,
        'tahun'    => $tahun,
        'laporan'  => $laporan,
        'admin'    => $admin_nama,
        'tanggal_cetak' => date('d/m/Y')
    ];

    $html = view('admin/laporan/anggota/pdf_template', $data);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); 
    $dompdf->render();
    $dompdf->stream("Laporan_Anggota_Angkatan_{$angkatan}_{$tahun}.pdf", ["Attachment" => false]);
}

    public function index()
    {
        $data = [
            'title' => 'Laporan Kehadiran',
            'list_bulan' => $this->_getListBulan(),
            'list_tahun' => range(date('Y'), date('Y') - 5),
        ];
        return view('admin/laporan/index', $data);
    }

    public function cetak()
{
    $bulan = $this->request->getPost('bulan');
    $tahun = $this->request->getPost('tahun');

    // 1. Hitung Total Pertemuan yang terjadi di bulan tersebut
    $totalPertemuan = $this->kehadiranModel
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->countAllResults();

    // 2. Ambil Rekap Per Anggota
    $laporan = $this->detailModel->select('
            detail_kehadiran.id_anggota, 
            anggota.nama, 
            kelas.nama_kelas,
            SUM(CASE WHEN detail_kehadiran.status_kehadiran = "hadir" THEN 1 ELSE 0 END) as total_hadir,
            SUM(CASE WHEN detail_kehadiran.status_kehadiran != "hadir" THEN 1 ELSE 0 END) as total_tidak_hadir,
            GROUP_CONCAT(DISTINCT detail_kehadiran.keterangan SEPARATOR ", ") as kumpulan_keterangan
        ')
        ->join('rekap_kehadiran', 'rekap_kehadiran.id_rekap = detail_kehadiran.id_rekap')
        ->join('anggota', 'anggota.id_anggota = detail_kehadiran.id_anggota')
        ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
        ->where('rekap_kehadiran.bulan', $bulan)
        ->where('rekap_kehadiran.tahun', $tahun)
        ->groupBy('detail_kehadiran.id_anggota')
        ->orderBy('anggota.nama', 'ASC')
        ->findAll();

    $data = [
        'title'           => 'LAPORAN REKAPITULASI BULANAN',
        'bulan'           => $this->_getListBulan()[$bulan],
        'tahun'           => $tahun,
        'total_pertemuan' => $totalPertemuan,
        'laporan'         => $laporan,
    ];

    $html = view('admin/laporan/pdf_template', $data);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); // Tetap landscape agar keterangan leluasa
    $dompdf->render();
    $dompdf->stream("Rekap_Kehadiran_{$bulan}_{$tahun}.pdf", ["Attachment" => false]);
}

    private function _getListBulan() {
        return ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
    }
}