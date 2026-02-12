<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek status login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        // 2. Cek role
        if (session()->get('role') !== 'admin') {
            // Jika bukan admin, arahkan ke dashboard anggota atau halaman error 403
            return redirect()->to(base_url('anggota/dashboard'))->with('warning', 'Akses Ditolak. Area ini hanya untuk Admin.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}