<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRhModel extends Model
{
    protected $table            = 'user_rh';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'full_name',
        'citizen_id',
        'no_hp_ic',
        'jenis_kelamin',
        'pin',
        'api_token',
        'role',
        'batch',
        'kode_nomor_induk_rs',
        'position',
        'tanggal_masuk',
        'file_ktp',
        'file_sim',
        'file_kta',
        'file_skb',
        'sertifikat_heli',
        'sertifikat_operasi',
        'dokumen_lainnya',
        'is_verified',
        'created_at',
        'updated_at',
        'is_active',
        'resign_reason',
        'resigned_by',
        'resigned_at',
        'reactivated_at',
        'reactivated_by',
        'reactivated_note',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
