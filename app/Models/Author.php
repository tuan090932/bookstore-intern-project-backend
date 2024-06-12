<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Author extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'author_id';

    protected $fillable = ['author_name', 'age', 'birth_date', 'death_date', 'deleted_at'];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
        'deleted_at' => 'date',
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

    public function getDeletedAtAttribute($value)
    {
        if ($value)
        {
            $deletedAt = Carbon::parse($value);
            return $deletedAt->format('d/m/Y');
        }
        else
        {
            return null;
        }
    }
}
