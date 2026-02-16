<?php

namespace App\Models;

use CodeIgniter\Model;

class PincodeModel extends Model
{
    protected $table = 'pincode_master';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'pincode',
        'area',
        'taluk',
        'district',
        'state'
    ];
}