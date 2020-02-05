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
       return $this->belongsToMany(User::class,'user_incomes');
    }
    public function user_incomes()
    {
       return $this->hasMany(UserIncome::class,'income_id');
    }
}
