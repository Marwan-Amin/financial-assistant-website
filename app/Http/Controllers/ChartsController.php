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
        $totalRevenue = DB::table('user_sub_categories')
            ->select('expense_categories.name as Category_Name', DB::raw('SUM(user_sub_categories.amount) as total'))
            ->join('expense_sub_categories', 'expense_sub_categories.id', '=', 'user_sub_categories.sub_category_id')
            ->join('expense_categories', 'expense_sub_categories.category_id', '=', 'expense_categories.id')
            ->join('users', 'user_sub_categories.user_id', '=', 'users.id')
            ->groupBy('expense_categories.name')->get()
            ;
        
dd($totalRevenue);
        return view('charts.charts');
    }
}




















// foreach($categories as $category){
//   foreach(Auth::user()->subExpenses as $subCategory){
//     if($subCategory->category->name ==$category->name){
//       if($userCategories == []){
//         $userCategories[]=['categoryName'=>$category->name,'total'=>$subCategory->pivot->amount];
//       }else{
//         foreach($userCategories as $userCategory){
//             if($userCategory['categoryName'] ==$category->name){
//               $userCategories[array_search($userCategory,$userCategories)]['total']+=$subCategory->pivot->amount;
//             }else{
//               $userCategories[]=['categoryName'=>$category->name,'total'=>$subCategory->pivot->amount];

//             }
//         }
//       }
//     }
//   }
// }        