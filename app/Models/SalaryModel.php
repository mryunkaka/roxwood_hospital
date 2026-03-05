<?php

namespace App\Models;

use CodeIgniter\Model;

class SalaryModel extends Model
{
    protected $table            = 'salary';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'medic_name',
        'medic_jabatan',
        'period_start',
        'period_end',
        'total_transaksi',
        'total_item',
        'total_rupiah',
        'bonus_40',
        'status',
        'paid_at',
        'paid_by',
        'created_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
