<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddExtraFieldsToMembers extends Migration
{
    public function up()
    {
         $this->forge->addColumn('members', [
            'marital_status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'gender',
            ],
            'ration_card_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
                'after'      => 'marital_status',
            ],
            'rationcard_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'after'      => 'ration_card_type',
            ],
            'father' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'name',
            ],
            'adhar' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'mobile',
            ],
            'pan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'adhar',
            ],
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'city',
            ],
            'voter' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'pan',
            ],
        ]);//
    }

    public function down()
    {
               $this->forge->dropColumn('members', [
            'marital_status',
            'ration_card_type',
            'rationcard_number',
            'father',
            'adhar',
            'pan',
            'country',
            'voter',
         ]);//
    }
}
