<?php

namespace App\Models;

use CodeIgniter\Model;

class IdentityMasterModel extends Model
{
    protected $table            = 'identity_master';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'citizen_id',
        'first_name',
        'last_name',
        'dob',
        'sex',
        'nationality',
        'image_path',
        'created_at',
        'updated_at',
        'active_version_id',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
