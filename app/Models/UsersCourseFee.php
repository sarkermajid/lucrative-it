<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersCourseFee extends Model
{
    protected $table='users_course_fee';

    protected $fillable = [
        'course_id', 'user_id','course_fee','discount','total_payment'
    ];

    public function course() {
        return $this->belongsTo(Training::class);
    }

    public function userinfo() {
        return $this->belongsTo(\App\User::class,'user_id');
    }

    public function paymentby() {
        return $this->belongsTo(\App\User::class,'payment_by');
    }


}
