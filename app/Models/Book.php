<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;


    protected $primaryKey = 'book_id';

    protected $fillable = [
        'title',
        'language_id',
        'num_pages',
        'publisher_id',
        'category_id',
        'image',
        'description',
        'price',
        'stock',
        'author_id',
    ];
}
