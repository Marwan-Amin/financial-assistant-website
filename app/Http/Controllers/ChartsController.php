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
       if(count($customCategories) > 0 || count($subCategories) >0 ){
        if(count($subCategories) > 0){
            foreach($subCategories as $subCategory){
                $userCategories[]=['categoryName'=>$subCategory->category->name,'category_id'=>$subCategory->category->id,'isCustom'=>'false'];
            }
        }
        if(count($customCategories) > 0){
            foreach($customCategories as $customCategory){
                $userCategories[]=['categoryName'=>$customCategory->name,'category_id'=>$customCategory->id,'isCustom'=>'true'];
           }
        }
        
       }else{
           $userCategories=['categoryName' => 'there is no category created','category_id'=>0,'isCustom'=>'false'];
       }
       
        //start expense array for chart

        $totalExpenses = DB::table('user_sub_categories')
            ->select('expense_categories.name as Category_Name', DB::raw('SUM(user_sub_categories.amount) as total'))
            ->join('expense_sub_categories', 'expense_sub_categories.id', '=', 'user_sub_categories.sub_category_id')
            ->join('expense_categories', 'expense_sub_categories.category_id', '=', 'expense_categories.id')
            ->join('users', 'user_sub_categories.user_id', '=', 'users.id')
            ->groupBy('expense_categories.name')->get();
            $totalCustomExpenses = DB::table('custom_sub_categories')
            ->select('custom_categories.name as Custom_Category_Name', DB::raw('SUM(custom_sub_categories.amount) as custom_total'))
            ->join('custom_categories', 'custom_categories.id', '=', 'custom_sub_categories.category_id')
            ->join('users', 'custom_categories.user_id', '=', 'users.id')
            ->groupBy('custom_categories.name')->get();
            
            // dd($totalCustomExpenses);
            // ,DB::raw('SUM(custom_sub_categories.amount) as total_custom')
            // ->join('custom_categories','custom_categories.user_id','=','users.id')
            // ->join('custom_sub_categories','custom_sub_categories.category_id','=','custom_categories.id')

            //end expense array for chart    
        
        //start sub-expense for chart
    //     $ExpensesArray=[];

    //     $subExpenses = Auth::user()->subExpenses;
    //    if(count($subExpenses)>0){
    //     foreach($subExpenses as $subExpense){
    //         $ExpensesArray[] = ["CategoryName" => $subExpense->category ,'amount'=>$subExpense->pivot->amount];
    //     }
    //    }
        
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
         [  'totalExpenses' => $totalExpenses ,
            'totalIncome' => $totalIncome ,
            'totalCustomExpeses'=>$totalCustomExpenses,
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
