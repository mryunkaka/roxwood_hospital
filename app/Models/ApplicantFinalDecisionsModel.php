<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantFinalDecisionsModel extends Model
{
    protected $table            = 'applicant_final_decisions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'applicant_id',
        'system_result',
        'overridden',
        'override_reason',
        'final_result',
        'decided_by',
        'decided_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
