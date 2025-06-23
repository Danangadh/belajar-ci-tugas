<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

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
    if ($this->request->getPost()) {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $dataUser = $this->user->where(['username' => $username])->first();

        if (!$dataUser) {
            die("Username tidak ditemukan di database.");
        }

        echo "Input Password: {$password}<br>";
        echo "Hash Password DB: {$dataUser['password']}<br>";

        if (password_verify($password, $dataUser['password'])) {
            echo "✅ Cocok! Password benar.";
        } else {
            echo "❌ Password salah.";
        }

        exit;
    } else {
        return view('v_login');
    }
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
