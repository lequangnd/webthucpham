<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details_invoices extends Model
{
    protected $table='details_invoices';
    public function units()
    {
        return $this->belongsTo('App\Models\Units','units_id','id');
    }
    public function products()
    {
        return $this->belongsTo('App\Models\Products','products_id','id');
    }
}
