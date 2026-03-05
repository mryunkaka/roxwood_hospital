<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = Services::authService();
        if (! $auth->isLoggedIn()) {
            return redirect()->to('/admin/login')->with('error', 'Please sign in.');
        }

        $rolesRequired = is_array($arguments) ? $arguments : [];
        if ($rolesRequired === []) {
            return null;
        }

        foreach ($rolesRequired as $role) {
            if ($auth->hasRole((string) $role)) {
                return null;
            }
        }

        return redirect()->to('/admin')->with('error', 'Access denied.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}

