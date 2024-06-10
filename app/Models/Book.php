<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // The table is associated with this model.
    protected $table = 'books';
    // Custom primary key for the Book model
    protected $primaryKey = 'book_id';

    // Fields that are mass assignable
    protected $fillable = [
        'title',
        'category_id',
        'price',
        'stock',
        'num_pages',
        'author_id',
        'publisher_id',
        'language_id',
        'image',
        'description',
    ];

    /**
     * Get the language associated with the book.
     * Get the publisher associated with the book.
     * Get the category associated with the book.
     * Get the author associated with the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'language_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'publisher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'author_id');
    }
}
