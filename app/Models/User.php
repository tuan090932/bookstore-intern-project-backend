<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Cart;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;

    protected $table = 'users';

    // Custom primary key for the User model
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_name',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the address associated with the user.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'user_id', 'user_id');
    }

    /**
     *
     * Get the orders associated with the user.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    /**
    * Retrieve the cart associated with the user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id', 'user_id');
    }

    public function bookOrders()
    {
        return $this->hasMany(BookOrder::class, 'user_id');
    }


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
