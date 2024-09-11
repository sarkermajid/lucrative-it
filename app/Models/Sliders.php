<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $table='ic_slider';

    protected $fillable = [
        'title','short_description','image','status'
    ];
}
