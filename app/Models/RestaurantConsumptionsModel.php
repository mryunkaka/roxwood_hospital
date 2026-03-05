<?php

namespace App\Models;

use CodeIgniter\Model;

class RestaurantConsumptionsModel extends Model
{
    protected $table            = 'restaurant_consumptions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'consumption_code',
        'restaurant_id',
        'restaurant_name',
        'recipient_user_id',
        'recipient_name',
        'delivery_date',
        'delivery_time',
        'packet_count',
        'price_per_packet',
        'tax_percentage',
        'subtotal',
        'tax_amount',
        'total_amount',
        'ktp_file',
        'notes',
        'status',
        'created_at',
        'updated_at',
        'created_by',
        'approved_by',
        'approved_at',
        'paid_by',
        'paid_at',
    ];

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
}
