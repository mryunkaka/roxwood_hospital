<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountLogsModel extends Model
{
    protected $table            = 'account_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'full_name_before',
        'full_name_after',
        'position_before',
        'position_after',
        'pin_changed',
        'created_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
