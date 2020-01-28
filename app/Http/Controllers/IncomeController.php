<?php

namespace App\Http\Controllers;
use DB;
use App\UserIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Controllers\Balance;

class IncomeController extends Controller
{
    function index() 
    {
        return view('incomes.index',[
            'user' => \App\User::find(Auth::user()->id)

        ]);
    }
    function create (){
        return view('incomes.create'); 
    }
    function store(StoreIncomeRequest $request)
    {
       $user = \App\User::find(Auth::user()->id);
       $income_id = $request->type;
       $income = \App\Income::find($income_id);
       $user->incomes()->attach($income,['amount' => $request->amount,'Date'=>$request->date]);

       
       $balanceObj=new Balance;
       $balanceObj->calculateBalance();

        return redirect()->route('incomes.index');
    }

    function destroy($income_id)
    {
        $income = UserIncome::findOrFail($income_id);
        $income->delete();


        $balanceObj=new Balance;
        $balanceObj->calculateBalance();

        return redirect()->route('incomes.index');
    }

    function update($income_id,StoreIncomeRequest $request)
    {
        $income = UserIncome::findOrFail($income_id);
        $income->amount = $request->amount;
        $income->Date = $request->date;
        $income->income_id= $request->type;
        $income->save();

        $balanceObj=new Balance;
        $balanceObj->calculateBalance();

        return redirect()->route('incomes.index');
    }
    function edit($income_id)
    {
        $income = UserIncome::find($income_id);
        return view('incomes.edit',[
            'income' => $income
        ]); 
        
    }

}
