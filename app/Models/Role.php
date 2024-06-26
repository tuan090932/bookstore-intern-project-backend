<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
    ];

    public function adminUsers()
    {
        return $this->hasMany(AdminUser::class, 'role_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $primaryKey = 'role_id';

    protected $keyType = 'string';

    protected $fillable = ['role_name'];
}
