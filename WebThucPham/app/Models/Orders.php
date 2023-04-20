<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table='orders';
    public function order_status()
    {
        return $this->belongsTo('App\Models\Order_status','order_status_id','id');
    }
}
