<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantDocumentsModel extends Model
{
    protected $table            = 'applicant_documents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'applicant_id',
        'document_type',
        'file_path',
        'is_valid',
        'validation_notes',
        'uploaded_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
