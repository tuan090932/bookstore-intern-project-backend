<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Cart;
use App\Models\Book;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_item';
    protected $primaryKey = 'item_id';
    protected $fillable = [
        'cart_id', 'book_id', 'quantity'
    ];

    /**
     * Get the cart associated with the cart item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    /**
     * Get the book associated with the cart item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}
