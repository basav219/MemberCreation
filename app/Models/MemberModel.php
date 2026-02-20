<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';

    protected $allowedFields = [

        // BASIC
        'customer_id','member_code','title','name','father',
        'residential_address','permanent_address',
        'mobile','email',

        // LOCATION
        'pincode','area','city','taluk','district','state','country',

        // PERSONAL
        'dob','age','gender','occupation','religion','caste',
        'adhar','pan','voter','marital_status',

        // DOCUMENTS
        'dl_no','gst_no','passport_no',
        'gas_consumer_no','gas_company','property_details',

        // NOMINEE
        'nominee_name','nominee_father','nominee_gender',
        'nominee_relation','nominee_adhar','nominee_address',
        'nominee_other_details','nominee_age','nominee_mobile',

        // BANK – DCC / ADB
        'dcc_adb_bankname','dcc_adb_accountnumber',
        'dcc_adb_ifsccode','dcc_adb_branchname',
        'dcc_adb_rupaycard','dcc_adb_cheque',

        // BANK – OTHER
        'other_bankname','other_accountnumber',
        'other_ifsccode','other_branchname',
        'other_rupaycard','other_cheque',

        // FILES
        'photo','signature',

        //INTRODUCER 
        'introducer_customer_id','introducer_name','introducer_father','introducer_mobile',

       
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Autocomplete search for introducer
    public function searchIntroducer($keyword)
    {
        return $this->like('customer_id', $keyword)
                    ->orLike('name', $keyword)
                    ->findAll(10);
    }
    // Generate next Customer ID in CUST0001 format
    public function generateCustomerId()
    {
        $last = $this->select('customer_id')
                     ->orderBy('id', 'DESC')
                     ->first();

        if (!$last || empty($last['customer_id'])) {
            return 'CUST0001';
        }

        // Extract numeric part and increment
        $num = (int)substr($last['customer_id'], 4) + 1;

        // Pad with zeros to maintain 4 digits
        return 'CUST' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
}
  
