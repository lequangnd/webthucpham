<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details_orders extends Model
{
    protected $table='details_orders';
    public function units()
    {
        return $this->belongsTo('App\Models\Units','units_id','id');
    }
    public function products()
    {
        return $this->belongsTo('App\Models\Products','products_id','id');
    }
}
