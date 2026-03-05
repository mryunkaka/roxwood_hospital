<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantInterviewResultsModel extends Model
{
    protected $table            = 'applicant_interview_results';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'applicant_id',
        'total_hr',
        'average_score',
        'final_grade',
        'final_notes',
        'hr_notes',
        'ml_flags',
        'ml_confidence',
        'ml_notes',
        'is_locked',
        'locked_at',
        'calculated_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
