<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ExpenseSubCategory;

class ExpenseCategory extends Model
{
    public function subCategory()
    {
       return $this->belongsToMany(ExpenseSubCategory::class);
    }
}
