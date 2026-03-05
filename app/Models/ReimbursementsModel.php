<?php

namespace App\Models;

use CodeIgniter\Model;

class ReimbursementsModel extends Model
{
    protected $table            = 'reimbursements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'reimbursement_code',
        'billing_source_type',
        'billing_source_name',
        'item_name',
        'description',
        'qty',
        'price',
        'amount',
        'receipt_file',
        'status',
        'created_by',
        'paid_by',
        'submitted_at',
        'paid_at',
        'payment_note',
        'created_at',
        'updated_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
