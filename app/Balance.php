<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Balance extends Model
{
  
    protected $fillable = [
        'total_expenses', 'total_income', 'user_id','date'
    ];
    

    public function user(){
       return $this->belongsTo(User::class);
    }

   
}
