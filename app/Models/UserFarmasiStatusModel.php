<?php

namespace App\Models;

use CodeIgniter\Model;

class UserFarmasiStatusModel extends Model
{
    protected $table            = 'user_farmasi_status';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'status',
        'last_activity_at',
        'last_confirm_at',
        'auto_offline_at',
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
