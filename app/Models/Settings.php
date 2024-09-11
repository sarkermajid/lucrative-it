<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table='ic_settings';

    protected $fillable = [
        'key', 'name', 'value'
    ];
}
