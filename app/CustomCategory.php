<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomCategory extends Model
{
    protected $fillable=['name','user_id','date'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function customSubCategories(){
        return $this->hasMany(CustomSubCategory::class,'category_id');

    }
}
