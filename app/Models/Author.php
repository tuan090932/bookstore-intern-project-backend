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

    protected $table = "authors";

    protected $primaryKey = 'author_id';

    protected $fillable = ['author_name', 'age', 'birth_date', 'death_date', 'deleted_at', 'national'];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
        'deleted_at' => 'date',
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

    /**
     * Format the deleted date attribute.
     *
     * @param string|null $value The deleted date value.
     * @return string|null The formatted deleted date or null if the value is null.
     */
    public function getDeletedAtAttribute($value)
    {
        if ($value) {
            $deletedAt = Carbon::parse($value);
            return $deletedAt->format('d/m/Y');
        } else {
            return null;
        }
    }

    /**
     * Get the books associated with the author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'author_id', 'author_id');
    }
}
