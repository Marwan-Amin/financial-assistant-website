<?php

namespace App\Http\Controllers;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App\Http\Requests\expensesRequest;
use App\UserSubCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Balance;

class ExpenseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $expenses = $user->subExpenses;
        return view('expenses.index',compact('expenses'));
    }

    public function create($id=null)
    {
        $expensesCategories = ExpenseCategory::all();

        if($id){
            $subExpenseUser = UserSubCategory::find($id);
            $expensesCategories = ExpenseCategory::all();
            return view('expenses.create',compact('subExpenseUser','expensesCategories'));
        }
        return view('expenses.create',compact('expensesCategories'));
    }
    public function getSubCategories($categoryId)
    {
        $subCategories=ExpenseSubCategory::where('category_id',$categoryId)->get();
        $subCategoriesInfo = [];

        if(count($subCategories) >= 0 ){
            foreach($subCategories as $subCategory){
                $subCategoriesInfo[]= ['name'=>$subCategory->name,'id'=>$subCategory->id,'sub_category_icon'=>$subCategory->sub_category_icon];
            }
        }else{
            $subCategoriesInfo = false;
        }

        
        return response()->json($subCategoriesInfo);
    }
    public function store(expensesRequest $request){
        
        $userSubCategory = UserSubCategory::where('user_id',Auth::user()->id)
                       ->where('date',$request->date)->where('sub_category_id',$request->subCategory);
        $userSubCategory=$userSubCategory->exists()?$userSubCategory->first():['amount'=>0];
         UserSubCategory::updateOrCreate(
        ['user_id'=>Auth::user()->id,'date'=>$request->date,'sub_category_id'=>$request->subCategory],   
        [
            'amount'=>$userSubCategory['amount']+$request->amount,
        ]);
      


        $balanceObj=new BalanceCalculation;
        $balanceObj->calculateBalance($request->date , $request->amount); 

        
        return redirect()->route('expenses.index');
    }

    public function destroy($id){
        $subExpense = UserSubCategory::findOrFail($id);
        $subExpense->delete();

        if($subExpense){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

    public function edit(expensesRequest $request,$id){
        $userSubCategory = UserSubCategory::find($id);
        $oldExpense = $userSubCategory->amount;
        $userSubCategory->sub_category_id = $request->subCategory;
        $userSubCategory->amount = $request->amount;
        $oldExpense = $userSubCategory->amount;

        $userSubCategory->date = $request->date;
        $userSubCategory->save();

        $addedExpense= $request->amount - $oldExpense;


        $balanceObj=new BalanceCalculation;
        $balanceObj->calculateBalance($request->date , $addedExpense);
        
        return redirect()->route('expenses.index');
    }
}
