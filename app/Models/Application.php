<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table='application_course';

    protected $fillable = [
        'name', 'phone','email','branch','institute','comments','training_id'
    ];

    public function training() {
        return $this->belongsTo(Training::class,'training_id');
    }


}
