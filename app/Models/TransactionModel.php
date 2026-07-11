<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'order_id',
        'snap_token',
        'payment_type',
        'transaction_status',
        'paid_at'
    ];

    protected $useTimestamps = true;
}