<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\DiskonModel; // pastikan model ini ada dan sudah dibuat

class AuthController extends BaseController
{
    protected $user;

    function __construct()
    {
        helper('form');
        $this->user = new UserModel();
    }

    public function login()
    {
        // Jika tombol login ditekan (POST)
        if ($this->request->getPost()) {
            $rules = [
                'username' => 'required|min_length[6]',
                'password' => 'required|min_length[7]|numeric',
            ];

            if ($this->validate($rules)) {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');

                $dataUser = $this->user->where(['username' => $username])->first();

                if ($dataUser) {
                    if (password_verify($password, $dataUser['password'])) {

                        // ✅ Ambil diskon hari ini
                        $diskonModel = new \App\Models\DiskonModel();
                         $today = date('Y-m-d');
                         $diskon = $diskonModel->where('tanggal', $today)->first();

                        // ✅ Siapkan array session login
                        $sessionData = [
                            'username'    => $dataUser['username'],
                            'role'        => $dataUser['role'],
                            'isLoggedIn'  => true,
                        ];

                        // ✅ Tambahkan diskon ke session jika ada
                        if ($diskon) {
                            $sessionData['diskon'] = $diskon['nominal'];
                        }

                        // ✅ Set session
                        session()->set($sessionData);

                        // ✅ Redirect ke halaman utama
                        return redirect()->to(base_url('/'));
                    } else {
                        session()->setFlashdata('failed', 'Kombinasi Username & Password Salah');
                        return redirect()->back();
                    }
                } else {
                    session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', $this->validator->listErrors());
                return redirect()->back();
            }
        }

        // Jika hanya buka halaman login (GET)
        return view('v_login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
