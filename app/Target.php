<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $fillable = [
        'target_name', 'target_amount', 'savings','progress'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
