<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantInterviewScoresModel extends Model
{
    protected $table            = 'applicant_interview_scores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'applicant_id',
        'hr_id',
        'criteria_id',
        'score',
        'notes',
        'created_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
