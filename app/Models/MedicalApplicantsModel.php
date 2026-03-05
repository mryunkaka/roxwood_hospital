<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicalApplicantsModel extends Model
{
    protected $table            = 'medical_applicants';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ic_name',
        'ooc_age',
        'ic_phone',
        'medical_experience',
        'city_duration',
        'online_schedule',
        'other_city_responsibility',
        'motivation',
        'work_principle',
        'academy_ready',
        'academy_reason',
        'rule_commitment',
        'duty_duration',
        'status',
        'rejection_stage',
        'created_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
