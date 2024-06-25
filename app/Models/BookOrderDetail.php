<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOrderDetail extends Model
{
    use HasFactory;
    protected $table = 'book_order_details';
    protected $primaryKey = ['book_id', 'order_id'];
    public $incrementing = false; // Important for composite keys
    protected $fillable = [
        'quantity',
        'price',
    ];
    
    /**
     * Defines a many-to-one relationship with BookOrder
     * A book order detail belongs to a book order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookOrder()
    {
        return $this->belongsTo(BookOrder::class, 'order_id', 'order_id');
    }

    /**
     * Defines a many-to-one relationship with Book
     * A book order detail belongs to a book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}
