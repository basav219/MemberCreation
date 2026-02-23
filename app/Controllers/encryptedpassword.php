<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class encryptedpassword extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();

        $admins = $db->table('admins')->get()->getResultArray();

        foreach ($admins as $admin) {

            // ⚠️ skip if already encrypted
            if (password_get_info($admin['password'])['algo'] !== 0) {
                continue;
            }

            $db->table('admins')->update(
                [
                    'password' => password_hash($admin['password'], PASSWORD_DEFAULT)
                ],
                [
                    'id' => $admin['id']
                ]
            );
        }

        return "✅ Admin passwords encrypted successfully";
    }
}