<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserIncome extends Model
{
    protected $fillable = [
        'amount','Date','user_id','income_id'
    ];
}
