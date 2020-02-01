<?php

namespace App\Http\Controllers;

use App\CustomCategory;
use App\CustomSubCategory;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function charts(){
        //get all categories which belongs to user or user has customize it
        $subCategories = Auth::user()->subExpenses;
        $customCategories = Auth::user()->customCategories;
        $userCategories = [];
       foreach($subCategories as $subCategory){
           $userCategories[]=['categoryName'=>$subCategory->category->name,'category_id'=>$subCategory->category->id,'isCustom'=>'false'];
       }foreach($customCategories as $customCategory){
            $userCategories[]=['categoryName'=>$customCategory->name,'category_id'=>$customCategory->id,'isCustom'=>'true'];
       }
        //start expense array for chart

        $totalRevenue = DB::table('user_sub_categories')
            ->select('expense_categories.name as Category_Name', DB::raw('SUM(user_sub_categories.amount) as total'))
            ->join('expense_sub_categories', 'expense_sub_categories.id', '=', 'user_sub_categories.sub_category_id')
            ->join('expense_categories', 'expense_sub_categories.category_id', '=', 'expense_categories.id')
            ->join('users', 'user_sub_categories.user_id', '=', 'users.id')
            ->groupBy('expense_categories.name')->get()
            ;
        //end expense array for chart    
        
        //start sub-expense for chart
        $subExpensesArray=[];

        $subExpenses = Auth::user()->subExpenses;
        foreach($subExpenses as $subExpense){
            $subExpensesArray[] = ["SubCategoryName" => $subExpense->name ,'amount'=>$subExpense->pivot->amount];
        }
        //end sub-expense for chart


        //start income array for chart
        $totalIncome = DB::table('user_incomes')
            ->select('incomes.type as type', DB::raw('SUM(user_incomes.amount) as total'))
            ->join('incomes', 'incomes.id', '=', 'user_incomes.income_id')
            ->groupBy('incomes.type')
            ->get();
        // dd($totalIncome);
        //end income array for chart

        return view('charts.charts' ,
         [  'totalRevenue' => $totalRevenue ,
            'totalIncome' => $totalIncome ,
            'subExpenses'=>$subExpensesArray,
            'userCategories'=>$userCategories
         ]);
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
