<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyDrip extends Model
{
    use HasFactory;
    public function available_for()
    {
        return $this->hasMany(PropertyDripBatches::class, 'property_drip_id', 'id');
    }
}
