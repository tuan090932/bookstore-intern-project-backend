<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Author extends Model
{
    use HasFactory;

    protected $primaryKey = 'author_id';

    protected $fillable = ['author_name', 'birth_date', 'death_date'];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
    ];

    public function getBirthDateAttribute($value)
    {
        if ($value)
        {
            $birthDate = Carbon::parse($value);
            return $birthDate ->format('d/m/Y');
        }
        else
        {
            return null;
        }
    }

    public function getDeathDateAttribute($value)
    {
        if ($value)
        {
            $deathDate = Carbon::parse($value);
            return $deathDate->format('d/m/Y');
        }
        else
        {
            return null;
        }
    }
}
