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
        $fullName = trim((string) $this->request->getPost('full_name'));
        $pin = (string) $this->request->getPost('pin');

        $rules = [
            'full_name' => 'required|max_length[100]',
            'pin'       => 'required|max_length[64]',
        ];

        if (! $this->validateData(['full_name' => $fullName, 'pin' => $pin], $rules)) {
            return redirect()->back()->withInput()->with('error', 'Invalid credentials.');
        }

        $auth = Services::authService();
        if (! $auth->loginUserRh($fullName, $pin)) {
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
