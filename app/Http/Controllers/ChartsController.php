<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\ExpenseSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class ChartsController extends Controller
{
    public function charts(){
        $categories = ExpenseCategory::all();
        $userCategories=[];
        foreach($categories as $category){
          foreach(Auth::user()->subExpenses as $subCategory){
            if($subCategory->category->name ==$category->name){
              if($userCategories == []){
                $userCategories[]=['categoryName'=>$category->name,'total'=>$subCategory->pivot->amount];
              }else{
                foreach($userCategories as $userCategory){
                    if($userCategory['categoryName'] ==$category->name){
                      $userCategories[array_search($userCategory,$userCategories)]['total']+=$subCategory->pivot->amount;
                    }else{
                      $userCategories[]=['categoryName'=>$category->name,'total'=>$subCategory->pivot->amount];

                    }
                }
              }
            }
          }
        }        
        
dd($userCategories);
        return view('charts.charts');
    }
}
