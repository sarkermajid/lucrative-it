<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table='ic_services';

    protected $fillable = [
        'title','short_description','icon_class'
    ];
}
