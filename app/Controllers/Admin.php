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
        $userType = $this->request->getPost('role');

        if (!$userType) {
            return redirect()->back()->with('error', 'Please select user type');
        }

        $adminModel = new AdminModel();

        $admin = $adminModel
            ->where('username', $username)
            ->where('role', $userType)
            ->first();

        if ($admin && password_verify($password, $admin['password'])) {

            session()->set([
                'is_admin_logged_in' => true,
                'admin_id'           => $admin['id'],
                'username'           => $admin['username'],
                'role'               => $admin['role'],
            ]);

            // ✅ FIXED REDIRECT
            if ($admin['role'] === 'superadmin') {
                return redirect()->to('/admin/dashboard');
            }

            return redirect()->to('/member/create');
        }

        return redirect()->back()->with('error', 'Invalid username, password, or role');
    }
public function dashboard()
{
    if (!session()->get('is_admin_logged_in')) {
        return redirect()->to('/admin/login');
    }

    if (session()->get('role') !== 'superadmin') {
        return redirect()->to('/member/create');
    }

    $adminModel = new \App\Models\AdminModel();

    $data['admins'] = $adminModel
        ->where('role !=', 'superadmin')
        ->findAll();

    return view('admin/dashboard', $data);
}
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }

    public function create()
{
    if (session()->get('role') !== 'superadmin') {
        return redirect()->to('/member/create');
    }

    return view('admin/create_admin');
}

public function store()
{
    if (session()->get('role') !== 'superadmin') {
        return redirect()->to('/member/create');
    }

    $adminModel = new \App\Models\AdminModel();

    $adminModel->insert([
        'username'   => $this->request->getPost('username'),
        'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'       => $this->request->getPost('role'),
        'created_at' => date('Y-m-d H:i:s')
    ]);

    return redirect()->to('/admin/dashboard')
        ->with('success', 'Admin created successfully');
}
// ✅ Must be public
    public function change_password($id)
    {
        $adminModel = new AdminModel();
        $data['admin'] = $adminModel->find($id);

        if (!$data['admin']) {
            return redirect()->to('/admin/dashboard')->with('error', 'Admin not found');
        }

        return view('admin/change_password', $data);
    }

    public function update_password($id)
    {
        $adminModel = new AdminModel();

        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('error', 'Passwords do not match');
        }

        $adminModel->update($id, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/admin/dashboard')->with('success', 'Password updated successfully');
    }



}