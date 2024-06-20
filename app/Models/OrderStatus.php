<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_status';
    protected $primaryKey = 'status_id';

    protected $fillable = [
        'status_name',
    ];
    /**
     * Defines a many-to-one relationship with BookOrder
     * An order status is associated with multiple book orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookOrders()
    {
        return $this->belongsTo(BookOrder::class, 'status_id', 'status_id');
    }
}
