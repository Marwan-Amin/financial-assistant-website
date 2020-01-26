<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ExpenseSubCategory;

class ExpenseCategory extends Model
{
    public function subCategories()
    {
       return $this->hasMany(ExpenseSubCategory::class,'category_id');
    }
}
