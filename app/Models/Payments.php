<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table='ic_payments';

    protected $fillable = [
        'user_course_id', 'amount','type','trabsaction_id','status','payment_by','update_by'
    ];

    public function usercourse() {
        return $this->belongsTo(UsersCourseFee::class,'user_course_id');
    }

    public function paymentby() {
        return $this->belongsTo(\App\User::class,'payment_by');
    }
}
