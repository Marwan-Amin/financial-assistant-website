<?php

namespace App\Http\Controllers\Finance;

use App\Balance;
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
        $oldIncomeRow = UserIncome::where('user_id' , Auth::user()->id)->where( 'date', $request->date)->where('income_id' ,$request->type)->first();
        $oldIncome = $oldIncomeRow != null?$oldIncomeRow->amount:0;
        
        UserIncome::updateOrCreate(
            ['user_id' => Auth::user()->id , 'Date'=> $request->date, 'income_id' =>$request->type ],
            ['amount' => $oldIncome + $request->amount ]
        );

        $balanceObj=new BalanceCalculation;
        $balanceObj->calculateBalance($request->date , $request->amount); 


        return redirect()->route('incomes.index');
    }

        function destroy($income_id)
        {
            $income = UserIncome::findOrFail($income_id);
            $income->delete();

            $balanceObj=new BalanceCalculation;
            $balanceObj->calculateBalanceOnDelete($income->Date , $income->amount);

            return redirect()->route('incomes.index');
        }
       

        function update($income_id, StoreIncomeRequest $request)
        {
            $income = UserIncome::findOrFail($income_id);

            $beforeUpdateDate = $income->Date;
            $beforeUpdateIncome = $income->amount;

            $income->amount = $request->amount;
            $income->Date = $request->date;
            $income->income_id= $request->type;
                 
            $updateIncomeDifference = $request->amount - $beforeUpdateIncome;

            $balanceObj=new BalanceCalculation;
            $balanceObj->calculateBalanceOnUpdate($request->date , $beforeUpdateDate ,$request->amount , $updateIncomeDifference);
            $income->save();

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

