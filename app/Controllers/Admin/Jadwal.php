<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\AnggotaModel;
use App\Models\KelasModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Jadwal extends BaseController
{
    protected $jadwalModel;
    protected $anggotaModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->anggotaModel = new AnggotaModel(); 
        $this->kelasModel = new KelasModel();
    }

    public function index()
    {
        $data['kelas'] = $this->jadwalModel->getJadwal();
        return view('admin/jadwal/index', $data);
    }

    public function detail($id_kelas)
    {
        $kelas = $this->jadwalModel->getKelasWithPelatih($id_kelas);
        $anggota = $this->jadwalModel->getAnggotaByKelas($kelas);

        $data = [
            'kelas' => $kelas,
            'anggota' => $anggota
        ];

        return view('admin/jadwal/detail', $data);
    }
    
    public function getKelasWithPelatih($id_kelas)
    {
        return $this->db->table('kelas')
            ->select('kelas.*, pelatih.nama AS nama_pelatih')
            ->join('pelatih', 'pelatih.id_pelatih = kelas.id_pelatih')
            ->where('kelas.id_kelas', $id_kelas)
            ->get()
            ->getRowArray();
    }
    

    // === CETAK PDF ===
    public function cetak($id_kelas)
    {
        $kelas = $this->jadwalModel->getKelasWithPelatih($id_kelas);
        $anggota = $this->jadwalModel->getAnggotaByKelas($kelas);

        $data = [
            'kelas' => $kelas,
            'anggota' => $anggota,
            'tanggal' => date('d/m/Y'),
        ];

        $html = view('admin/jadwal/cetak_pdf', $data);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Jadwal_Kelas_'.$kelas['nama_kelas'].'.pdf', ['Attachment' => true]);
    }

    public function moveAnggotaForm($id_anggota)
{
    $anggota = $this->anggotaModel->find($id_anggota);
    if (!$anggota) {
        return redirect()->back()->with('error', 'Anggota tidak ditemukan.');
    }

    $kelas_saat_ini = $this->kelasModel->find($anggota['id_kelas']);
    // Ambil semua kelas kecuali kelas anggota saat ini
    $allKelas = $this->kelasModel->where('id_kelas !=', $anggota['id_kelas'])->findAll();

    $data = [
        'title' => 'Pindah Kelas Anggota',
        'anggota' => $anggota,
        'kelas_list' => $allKelas,
        'nama_kelas_saat_ini' => $kelas_saat_ini['nama_kelas'] ?? 'Kelas Tidak Ditemukan', 
    ];

    return view('admin/jadwal/form_move', $data);
}

public function moveAnggotaUpdate($id_anggota)
{
    // Pastikan pengguna login (jika diperlukan)
    // if (! session()->get('logged_in')) return redirect()->to('/adminlogin');

    $new_id_kelas = $this->request->getPost('id_kelas');

    if (empty($new_id_kelas)) {
        return redirect()->back()->with('error', 'Kelas tujuan harus dipilih.');
    }

    // Update id_kelas anggota
    $this->anggotaModel->update($id_anggota, ['id_kelas' => $new_id_kelas]);

    return redirect()->to('/admin/jadwal/detail/'.$new_id_kelas)
                     ->with('success', 'Anggota berhasil dipindahkan ke kelas baru!');
}
}
