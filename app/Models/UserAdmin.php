<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    protected $table='users';

    protected $fillable = [
        'id','name'
    ];
}
