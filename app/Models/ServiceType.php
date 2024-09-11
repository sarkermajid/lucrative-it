<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table='ic_service_type';

    protected $fillable = [
        'title','link','short_description','image'
    ];
}
