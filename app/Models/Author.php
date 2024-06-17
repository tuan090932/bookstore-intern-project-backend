<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Author extends Model
{
    use HasFactory;

    protected $table = "authors";

    protected $primaryKey = 'author_id';

    protected $fillable = ['author_name', 'age', 'birth_date', 'death_date'];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
    ];

    /**
     * Format the birth date attribute.
     *
     * @param string|null $value The birth date value.
     * @return string|null The formatted birth date or null if the value is null.
     */
    public function getBirthDateAttribute($value)
    {
        if ($value) {
            $birthDate = Carbon::parse($value);
            return $birthDate->format('d/m/Y');
        } else {
            return null;
        }
    }

    /**
     * Format the death date attribute.
     *
     * @param string|null $value The death date value.
     * @return string|null The formatted death date or null if the value is null.
     */
    public function getDeathDateAttribute($value)
    {
        if ($value) {
            $deathDate = Carbon::parse($value);
            return $deathDate->format('d/m/Y');
        } else {
            return null;
        }
    }
}
