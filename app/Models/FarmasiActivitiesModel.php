<?php

namespace App\Models;

use CodeIgniter\Model;

class FarmasiActivitiesModel extends Model
{
    protected $table            = 'farmasi_activities';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'activity_type',
        'medic_user_id',
        'medic_name',
        'description',
        'created_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
