<?php

namespace App\Models;

use CodeIgniter\Model;

class ConsumersModel extends Model
{
    protected $table            = 'consumers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'first_name',
        'last_name',
        'dob',
        'sex',
        'nationality',
        'citizen_id',
        'pekerjaan',
        'registered_by',
        'registered_by_user_id',
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
