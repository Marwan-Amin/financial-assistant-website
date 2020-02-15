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
    public function calculateBalance($date ,$updateIncomeDifference = null, $updateExpenseDifference = null,$eventName = null)
    {
        $balancesData = Balance::where('user_id', Auth::user()->id);

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

        if($updateIncomeDifference != null) 
        {
        foreach ($balancesData->get() as $balance) {
            if ($date < $balance->date) 
            {
                $balance->total_income = $balance->total_income + $updateIncomeDifference;
                $balance->save();
            }
        }
        }

        if($updateExpenseDifference != null) 
        {            
                foreach ($balancesData->get() as $balance) {
                    if ($date < $balance->date) {
                        $balance->total_expenses = $balance->total_expenses + $updateExpenseDifference;
                        $balance->save();
                    }
                }
        }
    }

    public function calculateBalanceOnUpdate($requestDate, $beforeUpdateDate, $requestIncome='null', $updateIncomeDifference = 'null', $requestExpense='null', $updateExpenseDifference = 'null',$eventName = 'null')
    {

        $balancesData = Balance::where('user_id', Auth::user()->id);

        $incomes = DB::table('user_incomes')->where('user_id', Auth::user()->id)->where('date','<=',$requestDate)->sum('amount');
        $expenses = DB::table('user_sub_categories')->where('user_id', Auth::user()->id)->where('date','<=',$requestDate)->sum('amount');
        // dd($expenses);
       
        if($eventName != null){
           $event = CustomCategory::where('date',$requestDate)->where('name',$eventName)->where('user_id',Auth::user()->id)->first();
           $eventAmount =$event?CustomSubCategory::where('category_id',$event->id)->sum('amount'):0; 
 
        }else{
            $eventAmount = 0;
        }
        
        Balance::updateOrCreate(
            ['user_id' => Auth::user()->id , 'date'=> $requestDate ],
            ['total_income' => $incomes, 'total_expenses' => $expenses+$eventAmount ]
        );

        if(($updateIncomeDifference != "null" || is_numeric($updateIncomeDifference) ) && $beforeUpdateDate == $requestDate) 
        {

        foreach ($balancesData->get() as $balance) {
            if ($requestDate <= $balance->date) 
            {
                $balance->total_income = $balance->total_income + $updateIncomeDifference;
                $balance->save();
            }
        }
        } else if (($updateIncomeDifference != "null" || is_numeric($updateIncomeDifference)) && $beforeUpdateDate != $requestDate) {

            if ($updateIncomeDifference == 0.0) {

                if ($beforeUpdateDate > $requestDate ) {
                    $previousBalances = Balance::where('user_id', Auth::user()->id)->where('date', '<', $beforeUpdateDate)->where('date', '>=', $requestDate)->get();
                    $currentRow = Balance::where('user_id', Auth::user()->id)->where('date','=',$beforeUpdateDate)->first();
                    
                    $currentRow->total_income = 0;
                    if($currentRow->total_expenses == 0) {
                        $currentRow->delete();
                    } else {
                        $currentRow->save();
                    }

                    if (count($previousBalances) > 0) {
                        foreach ($previousBalances as $previousBalance) {
                            $previousBalance->total_income = $previousBalance->total_income + $requestIncome;  
                            $previousBalance->save(); 
                        }    
                    }
                } else if ($beforeUpdateDate < $requestDate) {
                    $nextBalances = Balance::where('user_id', Auth::user()->id)->where('date', '<', $requestDate)->where('date', '>', $beforeUpdateDate)->get();
                    $currentRow = Balance::where('user_id', Auth::user()->id)->where('date','=',$beforeUpdateDate)->first();
                    
                    $currentRow->total_income = 0;
                    if($currentRow->total_expenses == 0) {
                        $currentRow->delete();
                    } else {
                        $currentRow->save();
                    }
                    if (count($nextBalances) > 0) {
                        foreach ($nextBalances as $nextBalance) {
                            $nextBalance->total_income = $nextBalance->total_income - $requestIncome;
                            $nextBalance->save();
                        }
                    }
                }

            } else if ($beforeUpdateDate > $requestDate) {
                $previousRow = Balance::where('user_id', Auth::user()->id)->where('date','<',$beforeUpdateDate)->orderBy('date', 'desc')->limit(1)->first();
                $currentRow = Balance::where('user_id', Auth::user()->id)->where('date','=',$beforeUpdateDate)->first();
                if($previousRow != null){
                    $previousAmount = $previousRow->total_income;
                }else{
                    $previousAmount = 0;
                }
                $actualIncome = $currentRow->total_income - $previousAmount;
                
                $currentRow->total_income = 0;
                
                if($currentRow->total_expenses == 0) {
                    $currentRow->delete();
                } else {
                    $currentRow->save();
                }

                $previousBalances = Balance::where('user_id', Auth::user()->id)->where('date','<',$beforeUpdateDate)->where('date','>=',$requestDate)->get();
                $nextBalances = Balance::where('user_id', Auth::user()->id)->where('date','>',$beforeUpdateDate)->get();

                if(count($previousBalances) > 0){
                    foreach ($previousBalances as $previousBalance) {
                        $previousBalance->total_income = $previousBalance->total_income + $requestIncome;
                        $previousBalance->save();
                    }

                }

                if(count($nextBalances) > 0){
                    foreach ($nextBalances as $nextBalance) {
                        if($requestIncome > $actualIncome){
                            $nextBalance->total_income = $nextBalance->total_income + $updateIncomeDifference;

                        }else if($requestIncome < $actualIncome){
                            $nextBalance->total_income = $nextBalance->total_income - $updateIncomeDifference;

                        }
                        $nextBalance->save();
                    }
                }   
            } else if ($beforeUpdateDate < $requestDate) {
                $previousRow = Balance::where('user_id', Auth::user()->id)->where('date','<',$beforeUpdateDate)->orderBy('date', 'desc')->limit(1)->first();
                $currentRow = Balance::where('user_id', Auth::user()->id)->where('date','=',$beforeUpdateDate)->first();
                if($previousRow != null){
                        $previousAmount = $previousRow->total_income;
                }else{
                    $previousAmount = 0;
                }
                $actualIncome = $currentRow->total_income - $previousAmount;

                $currentRow->total_income = 0;
                
                if($currentRow->total_expenses == 0) {
                    $currentRow->delete();
                } else {
                    $currentRow->save();
                }

                $previousBalances = Balance::where('user_id', Auth::user()->id)->where('date','>',$beforeUpdateDate)->where('date','<',$requestDate)->get();
                $nextBalances = Balance::where('user_id', Auth::user()->id)->where('date','>=',$requestDate)->get();
                if($requestIncome >$actualIncome){
                    if(count($previousBalances) > 0){
                        foreach ($previousBalances as $previousBalance) {
                            $previousBalance->total_income = $previousBalance->total_income - $updateIncomeDifference;
                            $previousBalance->save();
                        }

                    }

                    if(count($nextBalances) > 0){
                        foreach ($nextBalances as $nextBalance) {
                            $nextBalance->total_income = $nextBalance->total_income + $updateIncomeDifference;
                            $nextBalance->save();
                        }
                    }
                }else if($requestIncome < $actualIncome){
                    if(count($previousBalances) > 0){
                        foreach ($previousBalances as $previousBalance) {
                            $previousBalance->total_income = $previousBalance->total_income - $actualIncome;
                            $previousBalance->save();
                        }

                    }

                        if(count($nextBalances) > 0){
                            foreach ($nextBalances as $nextBalance) {
                                $nextBalance->total_income = $nextBalance->total_income + $updateIncomeDifference;
                                $nextBalance->save();
                            }
                        }
                }
                   
            }
        }
        //////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////

        if(($updateExpenseDifference != "null" || is_numeric($updateExpenseDifference) ) && $beforeUpdateDate == $requestDate) 
        {            
                foreach ($balancesData->get() as $balance) {
                    if ($requestDate <= $balance->date) {
                        $balance->total_expenses = $balance->total_expenses + $updateExpenseDifference;
                        $balance->save();
                    }
                }
        } else if (($updateExpenseDifference != "null" || is_numeric($updateExpenseDifference)) && $beforeUpdateDate != $requestDate) {
            
            if ($updateExpenseDifference == 0.0) {

                if ($beforeUpdateDate > $requestDate ) {
                    $previousBalances = Balance::where('user_id', Auth::user()->id)->where('date', '<', $beforeUpdateDate)->where('date', '>=', $requestDate)->get();
                    $currentRow = Balance::where('user_id', Auth::user()->id)->where('date','=',$beforeUpdateDate)->first();
                    $currentRow->total_expenses = 0;
                    if($currentRow->total_income == 0) {
                        $currentRow->delete();
                    } else {
                        $currentRow->save();
                    }

                    if (count($previousBalances) > 0) {
                        foreach ($previousBalances as $previousBalance) {
                            $previousBalance->total_expenses = $previousBalance->total_expenses + $requestExpense;  
                            $previousBalance->save(); 
                        }    
                    }
                } else if ($beforeUpdateDate < $requestDate) {
                    $nextBalances = Balance::where('user_id', Auth::user()->id)->where('date', '<', $requestDate)->where('date', '>', $beforeUpdateDate)->get();
                    $currentRow = Balance::where('user_id', Auth::user()->id)->where('date','=',$beforeUpdateDate)->first();
                    
                    $currentRow->total_expenses = 0;
                    if($currentRow->total_income == 0) {
                        $currentRow->delete();
                    } else {
                        $currentRow->save();
                    }
                    if (count($nextBalances) > 0) {
                        foreach ($nextBalances as $nextBalance) {
                            $nextBalance->total_expenses = $nextBalance->total_expenses - $requestExpense;
                            $nextBalance->save();
                        }
                    }
                }

            }
        } else if ($beforeUpdateDate > $requestDate) {
            $previousRow = Balance::where('user_id', Auth::user()->id)->where('date','<',$beforeUpdateDate)->orderBy('date', 'desc')->limit(1)->first();
            $currentRow = Balance::where('user_id', Auth::user()->id)->where('date','=',$beforeUpdateDate)->first();
            if($previousRow != null){
                $previousAmount = $previousRow->total_expenses;
            }else{
                $previousAmount = 0;
            }
            $actualExpense = $currentRow->total_expenses - $previousAmount;
            
            $currentRow->total_expenses = 0;
            
            if($currentRow->total_income == 0) {
                $currentRow->delete();
            } else {
                $currentRow->save();
            }

            $previousBalances = Balance::where('user_id', Auth::user()->id)->where('date','<',$beforeUpdateDate)->where('date','>=',$requestDate)->get();
            $nextBalances = Balance::where('user_id', Auth::user()->id)->where('date','>',$beforeUpdateDate)->get();
            if(count($previousBalances) > 0){
                foreach ($previousBalances as $previousBalance) {

                    $previousBalance->total_expenses = $previousBalance->total_expenses + $requestExpense;
                    $previousBalance->save();
                }

            }

            if(count($nextBalances) > 0){
                foreach ($nextBalances as $nextBalance) {
                    if($requestExpense > $actualExpense){
                        $nextBalance->total_expenses = $nextBalance->total_expenses + $updateExpenseDifference;

                    }else if($requestExpense < $actualExpense){
                        $nextBalance->total_expenses = $nextBalance->total_expenses - $updateExpenseDifference;

                    }
                    $nextBalance->save();
                }
            }   
        } else if ($beforeUpdateDate < $requestDate) {
            $previousRow = Balance::where('user_id', Auth::user()->id)->where('date','<',$beforeUpdateDate)->orderBy('date', 'desc')->limit(1)->first();
            $currentRow = Balance::where('user_id', Auth::user()->id)->where('date','=',$beforeUpdateDate)->first();
            if($previousRow != null){
                    $previousAmount = $previousRow->total_expenses;
            }else{
                $previousAmount = 0;
            }
            $actualExpense = $currentRow->total_expenses - $previousAmount;

            $currentRow->total_expenses = 0;
            
            if($currentRow->total_income == 0) {
                $currentRow->delete();
            } else {
                $currentRow->save();
            }

            $previousBalances = Balance::where('user_id', Auth::user()->id)->where('date','>',$beforeUpdateDate)->where('date','<',$requestDate)->get();
            $nextBalances = Balance::where('user_id', Auth::user()->id)->where('date','>=',$requestDate)->get();
            
            if($requestExpense >$actualExpense){
                if(count($previousBalances) > 0){
                    foreach ($previousBalances as $previousBalance) {
                        $previousBalance->total_expenses = $previousBalance->total_expenses - $updateExpenseDifference;
                        $previousBalance->save();
                    }

                }

            if(count($nextBalances) > 0){
                    foreach ($nextBalances as $nextBalance) {
                        $nextBalance->total_expenses = $nextBalance->total_expenses + $updateExpenseDifference;
                        $nextBalance->save();
                    }
                }
            }else if($requestExpense < $actualExpense){
                if(count($previousBalances) > 0){
                    foreach ($previousBalances as $previousBalance) {
                        $previousBalance->total_expenses = $previousBalance->total_expenses - $actualExpense;
                        $previousBalance->save();
                    }

                }

                    if(count($nextBalances) > 0){
                        foreach ($nextBalances as $nextBalance) {
                            $nextBalance->total_expenses = $nextBalance->total_expenses + $updateExpenseDifference;
                            $nextBalance->save();
                        }
                    }
            }
               
        }


    }

    public function calculateBalanceOnDelete($date ,$updateIncomeDifference=null,$updateExpenseDifference=null,$eventName = null)
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

        if($updateIncomeDifference != null) 
        {
        foreach ($balancesData as $balance) {
            if ($date < $balance->date) 
            {
                $balance->total_income = $balance->total_income - $updateIncomeDifference;
                $balance->save();
            }
        }
        }

        if($updateExpenseDifference != null) 
        {
        foreach ($balancesData as $balance) {
            if ($date < $balance->date) 
            {
                $balance->total_expenses = $balance->total_expenses - $updateExpenseDifference;
                $balance->save();
            }
        }
        }
    }
}

?>