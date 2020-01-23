<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Income extends Model
{
    protected $fillable = [
        'type'
    ];

    public function users()
    {
       return $this->belongsToMany(User::class,'user_income');
    }
}
