<?php namespace App\Controllers\Anggota;

use App\Controllers\BaseController;
use App\Models\AnggotaModel; 
use App\Models\KelasModel; 

class Dashboard extends BaseController
{
    protected $anggotaModel;
    protected $kelasModel;
    
    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->kelasModel = new KelasModel();
    }

    public function index()
{
    $id_user = session()->get('id_user');
    $data_anggota_lengkap = $this->anggotaModel->getAnggotaWithKelas($id_user); 
    $status = $data_anggota_lengkap['status'] ?? 'tidak-aktif'; 

    $data = [
        'title'   => 'Dashboard Anggota',
        'anggota' => $data_anggota_lengkap, 
        'status'  => $status 
    ];

    if ($status === 'aktif') {
        // return view('anggota/profil/index', $data);
        return redirect()->to(base_url('/')); 
    } else {
        return view('anggota/dashboard', $data);
    }
 }
}
