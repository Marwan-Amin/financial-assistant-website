<?php

namespace App;

use App\ExpenseCategory;
use Illuminate\Database\Eloquent\Model;

class ExpenseSubCategory extends Model
{
    protected $fillable = [
        'name','category_id','sub_category_icon'
    ];

    public function users()
    {
       return $this->belongsToMany(User::class,'user_sub_categories');
    }

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
}
