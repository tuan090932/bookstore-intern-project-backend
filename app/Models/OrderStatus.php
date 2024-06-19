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

    public function bookOrders()
    {
        return $this->hasMany(BookOrder::class, 'status_id', 'status_id');
    }
}
