<?php

namespace App;

use App\ExpenseCategory;
use Illuminate\Database\Eloquent\Model;

class ExpenseSubCategory extends Model
{
    protected $fillable = [
        'name'
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
