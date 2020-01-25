<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserIncome extends Model
{
    protected $fillable = [
        'amount','Date','user_id','income_id'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function income(){
        return $this->belongsTo(Income::class,'income_id');
    }
}
