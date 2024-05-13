<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = ['tags' => 'array'];
    public function statusD(){
        return $this->belongsTo(Status::class,'status');
    }
    public function priorityD(){
        return $this->belongsTo(Priority::class,'priority');
    }
    public function assigned(){
        return $this->belongsTo(Admin::class,'assigned_users');
    }
}
