<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $table='invoices';
    public function suppliers()
    {
        return $this->belongsTo('App\Models\Suppliers','suppliers_id','id');
    }
}
