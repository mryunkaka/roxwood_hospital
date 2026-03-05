<?php

namespace App\Models;

use CodeIgniter\Model;

class AiTestResultsModel extends Model
{
    protected $table            = 'ai_test_results';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'applicant_id',
        'answers_json',
        'duration_seconds',
        'score_total',
        'consistency_score',
        'focus_score',
        'honesty_score',
        'attitude_score',
        'loyalty_score',
        'social_score',
        'risk_flags',
        'personality_summary',
        'decision',
        'created_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
