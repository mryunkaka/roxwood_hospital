<?php

namespace App\Models;

use CodeIgniter\Model;

class UserFarmasiSessionsModel extends Model
{
    protected $table            = 'user_farmasi_sessions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'medic_name',
        'medic_jabatan',
        'session_start',
        'session_end',
        'duration_seconds',
        'end_reason',
        'ended_by_user_id',
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
