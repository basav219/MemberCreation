<?php

namespace App\Models;

use CodeIgniter\Model;

class ShareModel extends Model
{
    protected $table = 'shares';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'customer_id',
        'share_type',
        'membership_date',
        'lf_number',
        'account_number',
        'resolution_date',
        'other_details',
          // New fields from Share Creation form
        'share_value',
        'number_of_shares',
        'share_amount',
        'share_fees',
        'entry_fees',
        'other_income',
        'building_fund',
        'total_income',
        'total_expense',
        'total',
        'receipt_no',
        'certificate_number',
        'receipt_mode',
        'payment_status',
        'transaction_detail'
    ];
}