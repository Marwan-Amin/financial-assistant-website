<?php

namespace App\Http\Controllers\Finance;

use App\Balance;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App\Http\Requests\expensesRequest;
use App\UserSubCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Finance\BalanceCalculation;
use App\User;

class ExpenseController extends Controller
{
    public function index()
    {   
        $user = User::find(Auth::user()->id);
        
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

        if($categoryId != 21){        
        $subCategories=ExpenseSubCategory::where('category_id',$categoryId)->get();
        $subCategoriesInfo = [];

        if(count($subCategories) >= 0 ){
            foreach($subCategories as $subCategory){
                $subCategoriesInfo[]= ['name'=>$subCategory->name,'id'=>$subCategory->id,'sub_category_icon'=>$subCategory->sub_category_icon];
            }
        }else{

            $subCategoriesInfo = false;
        }
    }else{
        return response()->json('others');

    }
        
        return response()->json($subCategoriesInfo);
    }
    public function store(expensesRequest $request){
        if(is_numeric($request->subCategory)){
            $userSubCategory = UserSubCategory::where('user_id',Auth::user()->id)
                       ->where('date',$request->date)->where('sub_category_id',$request->subCategory);
        $userSubCategory=$userSubCategory->exists()?$userSubCategory->first():['amount'=>0];

         UserSubCategory::updateOrCreate(
        ['user_id'=>Auth::user()->id,'date'=>$request->date,'sub_category_id'=>$request->subCategory],   
        [
            'amount'=>$userSubCategory['amount']+$request->amount,
        ]);

        }else {
            $subExpense = ExpenseSubCategory::create([
                'name'=> $request->subCategory,
                'category_id'=>'21',
                'sub_category_icon'=>'other'

            ]);
            $userSubCategory = UserSubCategory::create([
                'sub_category_id'=>$subExpense->id,
                'user_id'=>Auth::user()->id,
                'amount'=>$request->amount,
                'date'=>$request->date
            ]);
        }
        

        $balanceObj=new BalanceCalculation;
        $balanceObj->calculateBalance($request->date , null , $request->amount); 

        
        return redirect()->route('expenses.index');
    }

    public function destroy($id){

        $subExpense = UserSubCategory::findOrFail($id);
        $subExpense->delete();

        $balanceObj=new BalanceCalculation;
        $balanceObj->calculateBalanceOnDelete($subExpense->date ,null, $subExpense->amount);

        if($subExpense){
            return redirect()->route('expenses.index');
        }else{
            
        }
    }

    public function edit(Request $request,$id){
        
        $validator = Validator::make($request->all(), 
        [
            'amount'=>'numeric|min:0.25|required',
            'subCategory'=>'required'
        ]);
        if($validator->passes()){
            $userSubCategory = UserSubCategory::find($id);       
            // $beforeUpdateExpense = $userSubCategory!=null ?$userSubCategory->amount:0;
            // $updateExpenseDifference = $request->amount - $beforeUpdateExpense;
            
            
            $updateOrcreate = UserSubCategory::updateOrCreate(
                ['user_id'=>Auth::user()->id,'sub_category_id'=>$request->subCategory,'date'=>$userSubCategory->date],
                ['amount'=>$request->amount ]);
                
                $balanceObj=new BalanceCalculation;
                $balanceObj->calculateBalance($userSubCategory->date,null,$request->amount);
         
            if($userSubCategory->id != $updateOrcreate->id) {
                UserSubCategory::find($id)->delete();
            }
                 
            $userSubCategory->save();
    
            return redirect()->route('expenses.index');
        }
        return redirect()->route('expenses.edit',['id'=>$id]);
       
    }
}