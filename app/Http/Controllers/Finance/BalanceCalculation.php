<?php

namespace App\Http\Controllers\Finance;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Balance;


class BalanceCalculation
{
    public function calculateBalance($date ,$amounts)
    {
        $balancesData = Balance::where('user_id', Auth::user()->id)->get();

        $incomes = DB::table('user_incomes')->where('user_id', Auth::user()->id)->where('date','<=',$date)->sum('amount');
        $expenses = DB::table('user_sub_categories')->where('user_id', Auth::user()->id)->where('date','<=',$date)->sum('amount');
                
        Balance::updateOrCreate(
            ['user_id' => Auth::user()->id , 'date'=> $date ],
            ['total_income' => $incomes, 'total_expenses' => $expenses ]
        );
        foreach ($balancesData as $balance) {
            if ($date < $balance->date) 
            {
                $balance->total_income = $balance->total_income + $amounts;
                $balance->save();
            }
        }
    }
}

?>