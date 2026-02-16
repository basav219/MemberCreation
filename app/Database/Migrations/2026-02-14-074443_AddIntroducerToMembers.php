<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIntroducerToMembers extends Migration
{
    public function up()
    {
        $fields = [
            'introducer_member_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id', // adjust position if needed
                'comment'    => 'Introducer member ID (self reference)'
            ],
        ];

        $this->forge->addColumn('members', $fields);

        // Optional but RECOMMENDED foreign key
        $this->forge->addForeignKey(
            'introducer_member_id',
            'members',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->forge->dropForeignKey('members', 'members_introducer_member_id_foreign');
        $this->forge->dropColumn('members', 'introducer_member_id');
    }
}