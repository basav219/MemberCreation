<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMembersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'customer_id' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],

            'member_code' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],

            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],

            'residential_address' => [
                'type' => 'TEXT',
            ],

            'mobile' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],

            'telephone' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => true,
            ],

            'pincode' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],

            'city' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],

            'dob' => [
                'type' => 'DATE',
            ],

            'age' => [
                'type' => 'INT',
                'constraint' => 3,
            ],

            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],

            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],

            'occupation' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],

            'religion' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],

            'caste' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],

            'permanent_address' => [
                'type' => 'TEXT',
            ],

            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'signature' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('members');//
    }

    public function down()
    {
               $this->forge->dropTable('members');
 //
    }
}
