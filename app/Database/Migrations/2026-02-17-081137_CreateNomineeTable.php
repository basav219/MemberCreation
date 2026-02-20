<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNomineeTable extends Migration
{
    public function up()
    {
      $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'customer_id' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],

            // nominee details (same as members)
            'nominee_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'nominee_father' => ['type' => 'VARCHAR', 'constraint' => 100],
            'nominee_gender' => ['type' => 'VARCHAR', 'constraint' => 10],
            'nominee_relation' => ['type' => 'VARCHAR', 'constraint' => 50],
            'nominee_adhar' => ['type' => 'VARCHAR', 'constraint' => 20],
            'nominee_address' => ['type' => 'TEXT', 'null' => true],
            'nominee_other_details' => ['type' => 'TEXT', 'null' => true],
            'nominee_age' => ['type' => 'INT', 'constraint' => 3],
            'nominee_mobile' => ['type' => 'VARCHAR', 'constraint' => 15],
            'nominee_percentage' => ['type' => 'INT', 'constraint' => 3],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
            ]); 
             $this->forge->addKey('id', true);
             $this->forge->addKey('customer_id');
             $this->forge->createTable('nominees'); //
    }

    public function down()
    {
         $this->forge->dropTable('nominees');//
    }
}
