<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToAdmins extends Migration
{
    public function up()
    {
        $this->forge->addColumn('admins', [
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['superadmin', 'admin'],
                'default' => 'admin',
                'after' => 'password',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('admins', 'role');
    }
}