<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';

    // Custom primary key for the Address model
    protected $primaryKey = 'address_id';
    
    // Fields that are mass assignable
    protected $fillable = [
        'city',
        'country_name',
        'shipping_address',
        'user_id',
    ];
    /**
     * Get the user associated with the address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->BelongsTo(User::class, 'address_id', 'address_id');
    }
}
