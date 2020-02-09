<?php

namespace App\Http\Controllers\Finance;
use App\Http\Controllers\Controller;
use DB;
use App\UserIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Controllers\Finance\BalanceCalculation;
use App\Income;
use App\User;

class IncomeController extends Controller
{
    public function index()
    {
        return view('incomes.index', [
            'user' => User::find(Auth::user()->id)
        ]);
    }
    public function create()
    {
        return view('incomes.create');
    }
    public function store(StoreIncomeRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $income_id = $request->type;
        $income = Income::find($income_id);
        $user->incomes()->attach($income, ['amount' => $request->amount,'Date'=>$request->date]);

        $balanceObj=new BalanceCalculation;
        $balanceObj->calculateBalance($request->date , $request->amount); 


        return redirect()->route('incomes.index');
    }

        function destroy($income_id)
        {
            $income = UserIncome::findOrFail($income_id);
            $income->delete();
            return redirect()->route('incomes.index');
        }
       

        function update($income_id, StoreIncomeRequest $request)
        {
            $income = UserIncome::findOrFail($income_id);
            $oldIncome = $income->amount;
            $income->amount = $request->amount;
            $income->Date = $request->date;
            $income->income_id= $request->type;
            $income->save();

            $addedIncome= $request->amount - $oldIncome;

            $balanceObj=new BalanceCalculation;
            $balanceObj->calculateBalance($request->date , $addedIncome);

            return redirect()->route('incomes.index');
        }
        function edit($income_id)
        {
            $income = UserIncome::find($income_id);
            return view('incomes.edit', [
            'income' => $income
        ]);
        }
}

