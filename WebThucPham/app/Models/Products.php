<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table='products';
    public function trademarks()
    {
        return $this->belongsTo('App\Models\Trademarks','trademarks_id','id');
    }
    public function countries()
    {
        return $this->belongsTo('App\Models\Countries','countries_id','id');
    }
}
