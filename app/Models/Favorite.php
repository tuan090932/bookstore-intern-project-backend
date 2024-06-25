<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorite';

    protected $primaryKey = 'favorite_id';

    protected $fillable = [
        'user_id',
        'book_id',
    ];

    /**
     * relationship with model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * relationship with model Book.
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
