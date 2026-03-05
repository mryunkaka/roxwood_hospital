<?php

namespace App\Models;

use CodeIgniter\Model;

class EmsSalesModel extends Model
{
    protected $table            = 'ems_sales';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'service_type',
        'service_detail',
        'operasi_tingkat',
        'medicine_usage',
        'patient_name',
        'location',
        'qty',
        'price',
        'total',
        'payment_type',
        'medic_name',
        'medic_jabatan',
        'created_at',
        'billing_amount',
        'cash_amount',
        'doctor_share',
        'team_share',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
