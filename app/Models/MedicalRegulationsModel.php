<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicalRegulationsModel extends Model
{
    protected $table            = 'medical_regulations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category',
        'code',
        'name',
        'location',
        'price_type',
        'price_min',
        'price_max',
        'payment_type',
        'duration_minutes',
        'notes',
        'is_active',
        'created_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
