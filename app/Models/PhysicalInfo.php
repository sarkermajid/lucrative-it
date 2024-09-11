<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalInfo extends Model
{
    protected $table='hajji_physical_info';

    protected $fillable = [
        'strong_disease', 'blood_pressure','blood_group','diabetes','food_problem','walking_problem','is_use_english_commode','is_reading_quran','is_read_quran_sahih','is_salat_sahih_reading','hajji_id'
    ];
}
