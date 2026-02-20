<?php

namespace App\Models;

use CodeIgniter\Model;

class NomineeModel extends Model
{
    protected $table = 'nominees';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'customer_id',
        'nominee_name',
        'nominee_father',
        'nominee_gender',
        'nominee_relation',
        'nominee_adhar',
        'nominee_address',
        'nominee_other_details',
        'nominee_age',
        'nominee_mobile',
        'nominee_percentage'
    ];
}