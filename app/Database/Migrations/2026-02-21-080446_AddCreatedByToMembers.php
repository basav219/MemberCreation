<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedByToMembers extends Migration
{
    public function up()
    {$this->forge->addColumn('members', [
        'created_by' => [
            'type' => 'INT',
            'unsigned' => true,
            'after' => 'id',
        ],
    ]);
    }

    public function down()
    {
        $this->forge->dropColumn('members', 'created_by');//
    }
}
