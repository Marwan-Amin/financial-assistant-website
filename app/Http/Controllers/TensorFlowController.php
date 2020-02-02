<?php

namespace App\Http\Controllers;

use App\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TensorFlowController extends Controller
{
    public function getBalanceData()
    {
        $balances = Balance::where('user_id',Auth::user()->id)->get();
        $balanceArray=[];
        foreach($balances as $balance)
        {
            $balanceArray[]=[ 'totalExpenses' => $balance->total_expenses ,'totalIncome' => $balance->total_income, 'balance' => $balance->balance];
        }

        return response()->json($balanceArray);
    }

    public function index()
    {
        return view('predict');
    }
}
