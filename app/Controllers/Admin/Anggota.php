<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KelasModel;
use App\Models\UserModel;

class Anggota extends BaseController
{
    protected $anggotaModel;
    protected $kelasModel;
    protected $userModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->kelasModel = new KelasModel();
        $this->userModel = new UserModel();
    }

    private function hitungUmur($tglLahir)
    {
        if (empty($tglLahir)) return 0;
        try {
            $birthDate = new \DateTime($tglLahir);
            $today = new \DateTime('today');
            $umur = $today->diff($birthDate)->y;
            return $umur;
        } catch (\Exception $e) {
            return 0; // Kembalikan 0 jika format tanggal salah
        }
    }
    
    /**
     * Helper function untuk mengupload file ke folder yang spesifik
     * @param string $fieldName Nama field di form (e.g., 'file' atau 'bukti_tf')
     * @param string $folderName Sub-folder penyimpanan (e.g., 'datadiri' atau 'transfer')
     * @return string|null Nama file yang diupload atau null
     */
    private function uploadFile(string $fieldName, string $folderName)
    {
        $file = $this->request->getFile($fieldName);

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName(); // Generate nama unik
            $targetPath = ROOTPATH . 'public/uploads/' . $folderName;
            
            // Pastikan folder tersedia
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0777, true);
            }

            // Simpan file
            $file->move($targetPath, $newName);
            return $newName;
        }
        return null;
    }
   
    public function index()
{
    if (! session()->get('logged_in')) return redirect()->to('/adminlogin');

    $keyword = $this->request->getGet('keyword');

    $builder = $this->anggotaModel
        ->select('anggota.*, kelas.nama_kelas') 
        ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left') 
        ->orderBy('id_anggota', 'DESC');

    if ($keyword) {
        $builder->like('anggota.nama', $keyword)
                ->orLike('anggota.no_hp', $keyword)
                ->orLike('kelas.nama_kelas', $keyword); 
    }

    $data['anggota'] = $builder->findAll();
    
    $data['title'] = 'Data Anggota';
    $data['keyword'] = $keyword; 
    
    return view('admin/anggota/index', $data);
}

  
public function create()
{
    if (! session()->get('logged_in')) return redirect()->to('/adminlogin');
    $newIdAnggota = $this->anggotaModel->generateUniqueAnggotaId(date('Y-m-d'));
    
    $data['title'] = 'Tambah Anggota';
    $data['id_anggota_otomatis'] = $newIdAnggota; 
    $data['kelas_list'] = $this->kelasModel->findAll(); 
    
    return view('admin/anggota/form', $data);
}

        public function store()
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');

        $post = $this->request->getPost();
        $tglLahir = $this->request->getPost('tgl_lahir'); 
        $username = $this->request->getPost('username'); 
        $password = $this->request->getPost('password'); 
        // --- 1. VALIDASI DATA ---
        // Tambahkan validasi untuk username dan password di sini atau di UserModel
        if (! $this->anggotaModel->validate($post) || empty($username) || empty($password)) {
            // Jika validasi anggota gagal, atau username/password kosong
            $errors = $this->anggotaModel->errors();
            if (empty($username)) $errors['username'] = 'Username wajib diisi.';
            if (empty($password)) $errors['password'] = 'Password wajib diisi.';
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        // --- 2. LOGIKA OTOMATISASI DATA ANGGOTA ---
        $umur = $this->hitungUmur($tglLahir);
        $idKelasOtomatis = $this->kelasModel->findKelasByUmur($umur);
        $newIdAnggota = $this->anggotaModel->generateUniqueAnggotaId(date('Y-m-d'));

        if (empty($idKelasOtomatis)) {
            return redirect()->back()->withInput()->with('error', 'Umur anggota (' . $umur . ' tahun) tidak masuk dalam rentang kelas yang tersedia. Data gagal disimpan.');
        }

        // --- 3. LANGKAH A: BUAT AKUN USER DULU ---
        $userSaveData = [
            'username' => $username,
            // *** PENTING: PASSWORD HARUS DI HASH! ***
            'password' => password_hash($password, PASSWORD_BCRYPT), 
            'role'     => 'anggota', // Atur role default untuk anggota
            'nama'     => $this->request->getPost('nama'), // Jika tabel user juga menyimpan nama
        ];

        $id_user = $this->userModel->insert($userSaveData);

        if (! $id_user) {
            // Jika gagal membuat user (misal: username duplikat)
            return redirect()->back()->withInput()->with('error', 'Gagal membuat akun user. Kemungkinan Username sudah terpakai. Detail: ' . json_encode($this->userModel->errors()));
        }

        // --- 4. LANGKAH B: SIMPAN DATA ANGGOTA ---
        
        $dataToSave = [
            'id_anggota'       => $newIdAnggota,
            'id_user'          => $id_user, // <--- ID USER DARI LANGKAH A
            'nama'             => $this->request->getPost('nama'),
            // ... (data lainnya dari form)
            'jenis_kelamin'    => $this->request->getPost('jenis_kelamin'),
            'tgl_lahir'        => $tglLahir,
            'umur'             => $umur, 
            'no_hp'            => $this->request->getPost('no_hp'),
            'alamat'           => $this->request->getPost('alamat'),
            'pengalaman_tari'  => $this->request->getPost('pengalaman_tari'),
            'status'           => $this->request->getPost('status') ?? 'menunggu', 
            'id_kelas'         => $idKelasOtomatis, 
            'tgl_daftar'       => date('Y-m-d'), 
        ];

        // Handle File Upload (Optional)
        $dataToSave['file'] = $this->uploadFile('file', 'datadiri') ?? null;
        $dataToSave['bukti_tf'] = $this->uploadFile('bukti_tf', 'transfer') ?? null;
        
        // Eksekusi Insert
        if (! $this->anggotaModel->insert($dataToSave, false)) { 
            // Jika insert anggota gagal, **penting**: hapus user yang baru dibuat agar tidak ada user yatim!
            $this->userModel->delete($id_user); 
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data anggota. User yang baru dibuat telah dibatalkan.');
        }

        // Sukses
        return redirect()->to('/admin/anggota')->with('success','Anggota berhasil ditambahkan dengan ID: ' . $newIdAnggota);
    }

    public function edit($id_anggota)
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');

        $data['anggota'] = $this->anggotaModel->find($id_anggota);
        $data['title'] = 'Edit Anggota';
        $data['kelas_list'] = $this->kelasModel->findAll(); 
        
        return view('admin/anggota/form', $data);
    }

    public function update($id_anggota)
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/adminlogin');
        }
    
        $post = $this->request->getPost();
        
        // --- 1. LOGIKA OTOMATISASI DATA PADA UPDATE ---
        
        $tglLahir = $this->request->getPost('tgl_lahir');
        $umur = $this->hitungUmur($tglLahir);
        $idKelasOtomatis = $this->kelasModel->findKelasByUmur($umur);
        
        if (empty($idKelasOtomatis)) {
             // Jika tidak ada kelas yang cocok, biarkan ID kelas lama atau kembalikan error
             return redirect()->back()->withInput()->with('error', 'Umur anggota (' . $umur . ' tahun) tidak masuk dalam rentang kelas yang tersedia. Perubahan gagal disimpan.');
        }

        // Siapkan data update
        $dataToUpdate = $post; // Mulai dari semua data POST
        $dataToUpdate['umur'] = $umur; // Otomatisasi Umur
        $dataToUpdate['id_kelas'] = $idKelasOtomatis; // Otomatisasi Kelas
        
        // --- 2. Handle File Data Diri (file) ---
        $newFileName = $this->uploadFile('file', 'datadiri');
        if ($newFileName) {
            $oldFileName = $this->request->getPost('old_file');
            if ($oldFileName && file_exists(ROOTPATH . 'public/uploads/datadiri/' . $oldFileName)) {
                @unlink(ROOTPATH . 'public/uploads/datadiri/' . $oldFileName);
            }
            $dataToUpdate['file'] = $newFileName;
        } else {
            $dataToUpdate['file'] = $this->request->getPost('old_file');
        }

        // --- 3. Handle File Bukti Transfer (bukti_tf) ---
        $newBuktiTfName = $this->uploadFile('bukti_tf', 'transfer');
        if ($newBuktiTfName) {
            $oldBuktiTfName = $this->request->getPost('old_bukti_tf');
            if ($oldBuktiTfName && file_exists(ROOTPATH . 'public/uploads/transfer/' . $oldBuktiTfName)) {
                @unlink(ROOTPATH . 'public/uploads/transfer/' . $oldBuktiTfName);
            }
            $dataToUpdate['bukti_tf'] = $newBuktiTfName;
        } else {
            $dataToUpdate['bukti_tf'] = $this->request->getPost('old_bukti_tf');
        }

        // Hapus field old_file dan old_bukti_tf yang tidak ada di database
        unset($dataToUpdate['old_file']);
        unset($dataToUpdate['old_bukti_tf']);
        
        // --- 4. Eksekusi Update (dengan Validasi) ---
        if (!$this->anggotaModel->update($id_anggota, $dataToUpdate)) {
            $errors = $this->anggotaModel->errors();
            $errorMessage = "Gagal memperbarui data anggota. ";
            if (!empty($errors)) {
                 $errorMessage .= "Detail: <ul>";
                 foreach ($errors as $error) $errorMessage .= "<li>" . esc($error) . "</li>";
                 $errorMessage .= "</ul>";
            }
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    
        return redirect()->to('/admin/anggota')->with('success', 'Data anggota diperbarui');
    }
    

    public function delete($id_anggota)
{
    if (! session()->get('logged_in')) return redirect()->to('/adminlogin');
    
    // 1. Ambil data anggota yang akan dihapus untuk mendapatkan id_user
    $anggota = $this->anggotaModel->find($id_anggota);
    $id_user_to_delete = $anggota['id_user'] ?? null; // Ambil ID User
    
    // **Opsional: Tambahkan logika hapus file fisik di sini**
    if ($anggota) {
        if (!empty($anggota['file']) && file_exists(ROOTPATH . 'public/uploads/datadiri/' . $anggota['file'])) {
            @unlink(ROOTPATH . 'public/uploads/datadiri/' . $anggota['file']);
        }
        if (!empty($anggota['bukti_tf']) && file_exists(ROOTPATH . 'public/uploads/transfer/' . $anggota['bukti_tf'])) {
            @unlink(ROOTPATH . 'public/uploads/transfer/' . $anggota['bukti_tf']);
        }
    }
    // Akhir Opsional

    // 2. Hapus data anggota (Primary Action)
    $this->anggotaModel->delete($id_anggota);
    
    // 3. Hapus Akun User terkait (Secondary Action)
    if ($id_user_to_delete) {
        // Hapus baris di tabel users menggunakan id_user yang didapatkan
        $this->userModel->delete($id_user_to_delete); 
    }

    return redirect()->to('/admin/anggota')->with('success','Anggota dan Akun User terkait berhasil dihapus.');
}

    public function detail($id_anggota = null)
    {
        if (! session()->get('logged_in')) return redirect()->to('/adminlogin');

        if ($id_anggota === null) {
            return redirect()->to('/admin/anggota')->with('error', 'ID Anggota tidak ditemukan.');
        }
        
        // Asumsi: Kita perlu mengambil nama_kelas juga, jadi gunakan join
        $anggota = $this->anggotaModel
            ->select('anggota.*, kelas.nama_kelas') 
            ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
            ->where('anggota.id_anggota', $id_anggota)
            ->first();

        if (!$anggota) {
            return redirect()->to('/admin/anggota')->with('error', 'Data Anggota tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Anggota',
            'anggota' => $anggota
        ];

        return view('admin/anggota/detail', $data);
    }
    
}