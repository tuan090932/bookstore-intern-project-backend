<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'book_order_details';

    protected $fillable = [
        'order_id',
        'book_id',
        'quantity',
        'price',
    ];

    public function bookOrder()
    {
        return $this->belongsTo(BookOrder::class, 'order_id', 'order_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}
