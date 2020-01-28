<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ExpenseSubCategory;

class ExpenseCategory extends Model
{
    protected $fillable=['name','user_id'];
    public function subCategories()
    {
       return $this->hasMany(ExpenseSubCategory::class,'category_id');
    }
}
