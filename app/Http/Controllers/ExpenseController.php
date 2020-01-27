<?php

namespace App\Http\Controllers;
use DB;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App\Http\Requests\expensesRequest;
use App\User;
use App\UserSubCategory;
use Illuminate\Http\Request;
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
        foreach($subCategories as $subCategory){
            $subCategoriesInfo[]= ['name'=>$subCategory->name,'id'=>$subCategory->id];
        }
        return response()->json($subCategoriesInfo);
    }
    public function store(expensesRequest $request){
        UserSubCategory::create([
            'sub_category_id'=>$request->subCategory,
            'amount'=>$request->amount,
            'date'=>$request->date,
            'user_id'=>Auth::user()->id
        ]);
        
        $balanceObj=new Balance;
        $balanceObj->calculateBalance();
        
        return redirect()->route('expenses.index');
    }
    public function destroy($id){
        $subExpense = UserSubCategory::findOrFail($id);
        $subExpense->delete();

        $balanceObj=new Balance;
        $balanceObj->calculateBalance();

        if($subExpense){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }
    public function edit(expensesRequest $request,$id){
        $userSubCategory = UserSubCategory::find($id);
        $userSubCategory->sub_category_id = $request->subCategory;
        $userSubCategory->amount = $request->amount;
        $userSubCategory->date = $request->date;
        $userSubCategory->save();

        $balanceObj=new Balance;
        $balanceObj->calculateBalance();
        
        return redirect()->route('expenses.index');
    }
}
