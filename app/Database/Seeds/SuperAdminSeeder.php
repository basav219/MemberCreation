<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'superadmin',
            'password' => password_hash('admin@123', PASSWORD_DEFAULT),
            'role'     => 'superadmin',
          'created_at' => date('Y-m-d H:i:s')
        ];

        // Prevent duplicate insert
        $exists = $this->db->table('admins')
                           ->where('username', 'superadmin')
                           ->get()
                           ->getRow();

        if (!$exists) {
            $this->db->table('admins')->insert($data);
        }
    }
}