<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BookOrder extends Model
{
    use HasFactory;

    protected $table = 'book_order';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'order_date',
        'status_id',
        'total_price',
        'address_id',
        'order_address',
    ];

    /**
     * Defines a one-to-many relationship with BookOrderDetail
     * A book order can have multiple order details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookOrderDetails()
    {
        return $this->hasMany(BookOrderDetail::class, 'order_id', 'order_id');
    }

    /**
     * Defines a many-to-one relationship with User
     * A book order belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


    /**
     * Defines a many-to-one relationship with OrderStatus
     * A book order has a status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'status_id');
    }

    /**
     * Accessor for the total price attribute
     * Calculates the total price by summing the quantity and price of each order detail
     *
     * @return float
     */

    public function getTotalPriceAttribute()
    {
        return $this->bookOrderDetails->sum(function ($detail) {
            return $detail->quantity * $detail->price;
        });
    }
}
