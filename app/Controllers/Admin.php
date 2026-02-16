<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function login()
    {
        return view('admin/login');
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $admin = $adminModel->where('username', $username)->first();

        if ($admin && password_verify($password, $admin['password'])) {

            session()->set([
                'is_admin_logged_in' => true,
                'admin_id' => $admin['id'],
                'username' => $admin['username'],
            ]);

            return redirect()->to('member/create');
        }

        return redirect()->back()->with('error', 'Invalid username or password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('admin/login');
    }
}