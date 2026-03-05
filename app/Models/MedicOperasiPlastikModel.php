<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicOperasiPlastikModel extends Model
{
    protected $table            = 'medic_operasi_plastik';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'tanggal',
        'jenis_operasi',
        'alasan',
        'status',
        'approved_by',
        'approved_at',
        'id_penanggung_jawab',
        'created_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
