<?php

namespace App\Models;

use App\Models\Skills;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $connection = 'mysql';

    protected $table = 'users';

    protected $guarded = ['id'];

    public function skills()
    {
        return $this->hasMany(Skills::class, 'user_id');
    }
}
