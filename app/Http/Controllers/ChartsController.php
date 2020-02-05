<?php

namespace App\Http\Controllers;

use App\CustomCategory;
use App\CustomSubCategory;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function charts(){
        $userCharts = new User();
       $chartsInfo = $userCharts->charts();
       return view('charts.charts',compact('chartsInfo'));
    }
    public function getSubCategoriesForCharts(Request $request){
        //check if the user choose custom category or normal
            if($request->isCustom == 'true'){
                $userCategory = CustomCategory::find($request->categoryId);
                
                        return response()->json($userCategory->customSubCategories);  
            }else{
                $userSubCategories = Auth::user()->subExpenses;
                $userCategories=[];
                foreach($userSubCategories as $userSubCategory){
                    if($request->categoryId == $userSubCategory->category->id){
                        $userCategories[]=['name'=>$userSubCategory->name,'amount'=>$userSubCategory->pivot->amount];
                    }
                }
                return response()->json($userCategories);
            }
    }
}
