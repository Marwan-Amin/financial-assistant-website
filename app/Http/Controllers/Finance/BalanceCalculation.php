<?php

namespace App\Http\Controllers\Finance;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Balance;
use App\CustomCategory;
use App\CustomSubCategory;

class BalanceCalculation
{
    public function calculateBalance($date ,$incomeAmount = null, $expenseAmount = null,$eventName = null)
    {
        $balancesData = Balance::where('user_id', Auth::user()->id)->get();

        $incomes = DB::table('user_incomes')->where('user_id', Auth::user()->id)->where('date','<=',$date)->sum('amount');
        $expenses = DB::table('user_sub_categories')->where('user_id', Auth::user()->id)->where('date','<=',$date)->sum('amount');
        if($eventName != null){
           $event = CustomCategory::where('date',$date)->where('name',$eventName)->where('user_id',Auth::user()->id)->first();
           $eventAmount =$event?CustomSubCategory::where('category_id',$event->id)->sum('amount'):0; 
 
        }else{
            $eventAmount = 0;
        }
        
              
        Balance::updateOrCreate(
            ['user_id' => Auth::user()->id , 'date'=> $date ],
            ['total_income' => $incomes, 'total_expenses' => $expenses+$eventAmount ]
        );

        if($incomeAmount != null) 
        {
        foreach ($balancesData as $balance) {
            if ($date < $balance->date) 
            {
                $balance->total_income = $balance->total_income + $incomeAmount;
                $balance->save();
            }
        }
        }

        if($expenseAmount != null) 
        {
        foreach ($balancesData as $balance) {
            if ($date < $balance->date) 
            {
                $balance->total_expenses = $balance->total_expenses + $expenseAmount;
                $balance->save();
            }
        }
        }
        
    }

    public function calculateBalanceOnDelete($date ,$incomeAmount=null,$expenseAmount=null,$eventName = null)
    {
        $balancesData = Balance::where('user_id', Auth::user()->id)->get();

        $incomes = DB::table('user_incomes')->where('user_id', Auth::user()->id)->where('date','<=',$date)->sum('amount');
        $expenses = DB::table('user_sub_categories')->where('user_id', Auth::user()->id)->where('date','<=',$date)->sum('amount');
        if($eventName != null){
           $event = CustomCategory::where('date',$date)->where('name',$eventName)->where('user_id',Auth::user()->id)->first();
           $eventAmount =$event?CustomSubCategory::where('category_id',$event->id)->sum('amount'):0; 
        }else{
            $eventAmount = 0;
        }
        
        Balance::updateOrCreate(
            ['user_id' => Auth::user()->id , 'date'=> $date ],
            ['total_income' => $incomes, 'total_expenses' => $expenses+$eventAmount ]
        );

        if($incomeAmount != null) 
        {
        foreach ($balancesData as $balance) {
            if ($date < $balance->date) 
            {
                $balance->total_income = $balance->total_income - $incomeAmount;
                $balance->save();
            }
        }
        }

        if($expenseAmount != null) 
        {
        foreach ($balancesData as $balance) {
            if ($date < $balance->date) 
            {
                $balance->total_expenses = $balance->total_expenses - $expenseAmount;
                $balance->save();
            }
        }
        }
    }
}

?>