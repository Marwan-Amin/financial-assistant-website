<?php

namespace App\Http\Controllers;

use App\UserIncome;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    function index() 
    {
        return view('incomes',[
            'UserIncomes' => UserIncome::all()
        ]);
    }

    function store()
    {
        UserIncome::create([
            'income_id' => request()->income,
            'amount' => request()->amount,
            'Date' =>request()->date,
            'user_id'=>request()->user()->id,
        ]);
        return redirect()->route('incomes');
    }

    function destroy($income)
    {
        $delIncome = UserIncome::find($income);
        $delIncome->delete();
        return redirect()->route('incomes');
    }


}
