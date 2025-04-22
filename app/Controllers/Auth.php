<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-12
 * 
 * Auth Controller
 */

namespace App\Controllers;

use ReCaptcha\ReCaptcha;

class Auth extends BaseController
{
    protected $recaptcha;
    
    public function __construct()
    {
        $this->recaptcha = new ReCaptcha(config('Recaptcha')->secretKey);
    }

    public function index()
    {
        $data = [
            'title'         => 'Dashboard',
            'Pengaturan'    => $this->pengaturan
        ];

        // If already logged in, redirect to dashboard
        if ($this->ionAuth->loggedIn()) {
            return redirect()->to('/dashboard');
        }
        return $this->login();
    }

    public function login()
    {
        // If already logged in, redirect to dashboard
        if ($this->ionAuth->loggedIn()) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title'         => 'Login',
            'Pengaturan'    => $this->pengaturan,
            'breadcrumbs'   => 'login/breadcrumbs',
            'view'          => 'login/login'  // Will be prefixed with admin-lte-2/
        ];

        return view('admin-lte-2/layouts/top-nav', $data);
    }

    public function cek_login()
    {
        # Load helper validasi
        $validasi = \Config\Services::validation();
        
        # Get form data
        $user = $this->request->getVar('user');
        $pass = $this->request->getVar('pass');
        $inga = $this->request->getVar('ingat');
        
        # Check if user exists first
        $cek = $this->ionAuth->usernameCheck($user);
        
        if (!$cek) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID Pengguna atau Kata Sandi salah!'
            ]);
        }

        # Try to login
        $inget_ya = ($inga == '1' ? TRUE : FALSE);
        $login = $this->ionAuth->login($user, $pass, $inget_ya);

        if(!$login) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID Pengguna atau Kata Sandi salah!'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Login berhasil!',
            'redirect' => base_url('dashboard')
        ]);
    }

    public function logout()
    {
        $this->ionAuth->logout();
        session()->setFlashdata('toastr', ['type' => 'success', 'message' => 'Anda berhasil keluar dari aplikasi.']);
        return redirect()->to('/auth/login');
    }

    public function forgot_password()
    {
        $this->data['title'] = 'Lupa Kata Sandi';

        if ($this->request->getMethod() === 'post') {
            $this->validation->setRules([
                'identity' => 'required|valid_email',
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $identity = $this->request->getVar('identity');
                
                if ($this->ionAuth->forgottenPassword($identity)) {
                    session()->setFlashdata('toastr', ['type' => 'success', 'message' => $this->ionAuth->messages()]);
                    return redirect()->back();
                } else {
                    session()->setFlashdata('toastr', ['type' => 'error', 'message' => $this->ionAuth->errors()]);
                    return redirect()->back();
                }
            }
        }

        return view('admin-lte-2/login/forgot_password', $this->data);
    }
} 