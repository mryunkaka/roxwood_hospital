<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPushSubscriptionsModel extends Model
{
    protected $table            = 'user_push_subscriptions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'endpoint',
        'p256dh',
        'auth',
        'created_at',
        'updated_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
