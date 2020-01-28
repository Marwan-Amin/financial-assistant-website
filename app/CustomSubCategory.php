<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomSubCategory extends Model
{
    protected $fillable=['name','category_id','date','amount'];
    public function customCategory(){
        return $this->belongsTo(CustomCategory::class);
    }
}
