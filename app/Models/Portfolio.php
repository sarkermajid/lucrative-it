<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table='ic_portfolio';

    public function type()
    {
        return $this->belongsTo(PortfolioType::class);
    }
}
