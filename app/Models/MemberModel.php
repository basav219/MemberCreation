<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'customer_id',
        'member_code',
        'title',
        'name',
        'residential_address',
        'mobile',
        'telephone',
        'pincode',
        'city',
        'dob',
        'age',
        'email',
        'gender',
        'occupation',
        'religion',
        'caste',
        'permanent_address',
        'photo',
        'signature'
    ];
}