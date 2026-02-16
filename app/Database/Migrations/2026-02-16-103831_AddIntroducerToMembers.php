<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIntroducerToMembers extends Migration
{
    public function up()
    {
        $fields = [
            'introducer_customer_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'introducer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'introducer_father' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'introducer_mobile' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => true,
            ],
        ];

        $this->forge->addColumn('members', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('members', [
            'introducer_customer_id',
            'introducer_name',
            'introducer_father',
            'introducer_mobile',
        ]);
    }
}