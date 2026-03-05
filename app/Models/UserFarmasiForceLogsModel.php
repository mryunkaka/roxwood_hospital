<?php

namespace App\Models;

use CodeIgniter\Model;

class UserFarmasiForceLogsModel extends Model
{
    protected $table            = 'user_farmasi_force_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'target_user_id',
        'forced_by_user_id',
        'reason',
        'forced_at',
        'created_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
