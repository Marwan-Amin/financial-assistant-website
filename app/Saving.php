<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    protected $fillable = [
        'amount',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
