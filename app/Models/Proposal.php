<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = ['tags' => 'array'];

    public function items(){
        return $this->hasMany('App\Models\ProposalItem','proposal_id');
    }

}
