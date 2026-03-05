<?php

namespace App\Models;

use CodeIgniter\Model;

class IdentityVersionsModel extends Model
{
    protected $table            = 'identity_versions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'identity_id',
        'citizen_id',
        'first_name',
        'last_name',
        'dob',
        'sex',
        'nationality',
        'image_path',
        'change_reason',
        'changed_by',
        'created_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
