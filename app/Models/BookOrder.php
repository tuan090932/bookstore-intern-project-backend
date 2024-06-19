<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOrder extends Model
{
    use HasFactory;

    protected $table = 'book_order';

    protected $fillable = [
        'order_id',
        'user_id',
        'order_date',
        'status_id',
        'total_price',
        'address_id',
        'order_address',
    ];

    public function bookOrderDetails()
    {
        return $this->hasMany(BookOrderDetail::class, 'order_id', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'status_id');
    }
}
