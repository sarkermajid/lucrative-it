<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table='ic_service';

    protected $fillable = [
        'logo','title', 'service_type_id','status'
    ];
}
