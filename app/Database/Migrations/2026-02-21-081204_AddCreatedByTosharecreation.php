<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedByTosharecreation extends Migration
{
   public function up()
{
    $this->forge->addColumn('shares', [
        'created_by' => [
            'type' => 'INT',
            'unsigned' => true,
            'after' => 'id',
        ],
    ]);
}

    public function down()
    {
                $this->forge->dropColumn('shares', 'created_by');//
//
    }
}
