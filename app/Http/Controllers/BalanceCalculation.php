<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Balance;


class BalanceCalculation
{
    public function calculateBalance($date ,$amounts)
    {
        $balancesData = Balance::where('user_id', Auth::user()->id)->get();

            $incomesss = DB::table('user_incomes')->where('user_id', Auth::user()->id)->where('date','<=',$date)->sum('amount');
            $expensess = DB::table('user_sub_categories')->where('user_id', Auth::user()->id)->where('date','<=',$date)->sum('amount');
                
            DB::table('balances')->updateOrInsert(
                        ['user_id' => Auth::user()->id , 'date'=> $date ],
                        ['total_income' => $incomesss, 'total_expenses' => $expensess ]
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