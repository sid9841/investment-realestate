<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = ['tags' => 'array'];

    public function items(){
        return $this->hasMany('App\Models\InvoiceItem','invoice_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\User','customer_id');
    }
}
