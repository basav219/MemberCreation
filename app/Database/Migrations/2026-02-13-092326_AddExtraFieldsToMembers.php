<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddExtraFieldsToMembers extends Migration
{
    public function up()
    {
        $fields = [

            // LOCATION
            'area'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'taluk'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'district' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'state'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],

            // DOCUMENTS
            'dl_no'           => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'gst_no'          => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'passport_no'     => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'gas_consumer_no' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'gas_company'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'property_details'=> ['type' => 'TEXT', 'null' => true],

            // NOMINEE
            'nominee_name'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'nominee_father'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'nominee_gender'  => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => true],
            'nominee_relation'=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'nominee_adhar'   => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'nominee_address' => ['type' => 'TEXT', 'null' => true],
            'nominee_other_details' => ['type' => 'TEXT', 'null' => true],
            'nominee_age'     => ['type' => 'INT', 'constraint' => 3, 'null' => true],
            'nominee_mobile'  => ['type' => 'VARCHAR', 'constraint' => 15, 'null' => true],

            // DCC / ADB BANK
            'dcc_adb_bankname'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'dcc_adb_accountnumber'=> ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'dcc_adb_ifsccode'     => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'dcc_adb_branchname'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'dcc_adb_rupaycard'    => ['type' => 'ENUM("yes","no")', 'default' => 'no'],
            'dcc_adb_cheque'       => ['type' => 'ENUM("yes","no")', 'default' => 'no'],

            // OTHER BANK
            'other_bankname'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'other_accountnumber'=> ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'other_ifsccode'     => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'other_branchname'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'other_rupaycard'    => ['type' => 'ENUM("yes","no")', 'default' => 'no'],
            'other_cheque'       => ['type' => 'ENUM("yes","no")', 'default' => 'no'],
        ];

        $this->forge->addColumn('members', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('members', [
            'area','taluk','district','state',
            'dl_no','gst_no','passport_no','gas_consumer_no','gas_company','property_details',
            'nominee_name','nominee_father','nominee_gender','nominee_relation','nominee_adhar',
            'nominee_address','nominee_other_details','nominee_age','nominee_mobile',
            'dcc_adb_bankname','dcc_adb_accountnumber','dcc_adb_ifsccode','dcc_adb_branchname',
            'dcc_adb_rupaycard','dcc_adb_cheque',
            'other_bankname','other_accountnumber','other_ifsccode','other_branchname',
            'other_rupaycard','other_cheque'
        ]);
    }
}