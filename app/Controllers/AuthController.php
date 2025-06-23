<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\userModel;

class AuthController extends BaseController
{
    protected $user;

    function __construct()
    {
        helper('form');
        $this->user= new UserModel();
    } 

    public function login()
{
    if ($this->request->getPost()) {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $dataUser = $this->user->where(['username' => $username])->first();

        if ($dataUser) {
	        if (password_verify($password, $dataUser['password'])) {

        if ($username == $dataUser['username']) {
            if (md5($password) == $dataUser['password']) {
                session()->set([
                    'username' => $dataUser['username'],
                    'role' => $dataUser['role'],
                    'isLoggedIn' => TRUE
                ]);

                return redirect()->to(base_url('/'));
            } else {
                session()->setFlashdata('failed', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('failed', 'Username Tidak Ditemukan');
            return redirect()->back();
        }
    } else {
        return view('v_login');
         } // Tambahkan ini untuk menutup fungsi login()
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

}
}
}