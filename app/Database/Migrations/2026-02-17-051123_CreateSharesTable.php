<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSharesTable extends Migration
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
                'constraint' => 50,
            ],
            'share_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'membership_date' => [
                'type' => 'DATE',
            ],
            'lf_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'account_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'resolution_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'other_details' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey(
            'customer_id',
            'members',
            'customer_id',
            'CASCADE',
            'CASCADE'
        );
        $this->forge->createTable('shares');
    }

    public function down()
    {
        $this->forge->dropTable('shares');
    }
}