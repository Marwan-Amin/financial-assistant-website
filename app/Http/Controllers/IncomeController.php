<?php

namespace App\Http\Controllers;

use App\UserIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    function store(Request $request)
    {
        dd($request->type);
       $user = \App\User::find(Auth::user()->id);
       $income_id = $request->type;
       $income = \App\Income::find($income_id);
       $user->income()->attach($income,['amount' => $request->amount,'Date'=>$request->date]);
        
        return redirect()->route('incomes.index');
    }

    function destroy($income_id)
    {
        $delIncome = UserIncome::find($income_id);
        $delIncome->delete();
        return redirect()->route('incomes.index');
    }

    function update($income_id,Request $request)
    {
        $income = UserIncome::findOrFail($income_id);
        $income->amount = $request->amount;
        $income->Date = $request->date;
        $income->save();
        return redirect()->route('incomes.index');
    }
    function edit($income_id)
    {
        $income = UserIncome::find($income_id);
        //dd($income);
        return view('incomes.edit',[
            'income' => $income
        ]); 
        
    }

}
