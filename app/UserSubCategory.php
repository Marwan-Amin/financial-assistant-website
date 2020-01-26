<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubCategory extends Model
{
    protected $fillable=['sub_category_id','amount','user_id','date'];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function subCategory(){
        return $this->belongsTo(ExpenseSubCategory::class,'sub_category_id');
    }
}
