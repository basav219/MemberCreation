<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateshareDetailsTable extends Migration
{
    public function up()
    {
       $fields=[
          
            // Financial / Payment Fields
            'share_value' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0
            ],
            'number_of_shares' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'share_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0
            ],
            'share_fees' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0
            ],
            'entry_fees' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0
            ],
            'other_income' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0
            ],
            'building_fund' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0
            ],
            'total_income' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0
            ],
            'total_expense' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0
            ],
            'total' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0
            ],

            // Receipt / Payment
            'receipt_no' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'certificate_number' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'receipt_mode' => [
                'type' => 'ENUM',
                'constraint' => ['cash','cheque'],
                'default' => 'cash'
            ],
            'payment_status' => [
                'type' => 'ENUM',
                'constraint' => ['paid','pending'],
                'default' => 'pending'
            ],
            'transaction_detail' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            
        ];

               $this->forge->addColumn('shares', $fields);

    }

    public function down()
    {
        $this->forge->dropColumn('shares', [
            'share_value',
            'number_of_shares',
            'share_amount',
            'share_fees','certificate_number','receipt_mode', 'payment_status','transaction_detail',
            'entry_fees','other_income','building_fund','total_income','total_expense','total','receipt_no' ,
        ]);
    }
}