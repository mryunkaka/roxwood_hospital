<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table            = 'sales';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'consumer_name',
        'consumer_id',
        'medic_name',
        'medic_user_id',
        'medic_jabatan',
        'package_id',
        'package_name',
        'price',
        'qty_bandage',
        'qty_ifaks',
        'qty_painkiller',
        'keterangan',
        'created_at',
        'tx_hash',
        'identity_id',
        'synced_to_sheet',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
