<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;

class Auth extends BaseController
{
    public function login()
    {
        return view('admin/login', [
            'title'       => 'Sign In',
            'assetVersion'=> '1',
        ]);
    }

    public function attempt()
    {
        helper(['form']);

        $email = (string) $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');

        $rules = [
            'email'    => 'required|valid_email|max_length[254]',
            'password' => 'required|max_length[256]',
        ];

        if (! $this->validateData(['email' => $email, 'password' => $password], $rules)) {
            return redirect()->back()->withInput()->with('error', 'Invalid credentials.');
        }

        $auth = Services::authService();
        if (! $auth->loginAdmin($email, $password)) {
            return redirect()->back()->withInput()->with('error', 'Invalid credentials.');
        }

        return redirect()->to('/admin')->with('success', 'Signed in.');
    }

    public function logout()
    {
        Services::authService()->logout();
        return redirect()->to('/admin/login')->with('success', 'Signed out.');
    }
}
