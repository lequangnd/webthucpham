<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table='comments';
    public function users()
    {
        return $this->belongsTo('App\Models\User','users_id','id');
    }
}
