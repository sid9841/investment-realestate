<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function items(){
        return $this->hasMany('App\Models\EstimateItem','estimate_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\User','customer_id');
    }
}

