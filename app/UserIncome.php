<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserIncome extends Model
{
    protected $fillable = [
        'amount','Date','user_id','income_id'
    ];

    public function user(){
     return   $this->belongsTo(User::class,'user_id');
    }
}
