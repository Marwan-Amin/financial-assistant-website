<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;


class BalanceController extends Controller
{
    public function calculateBalance()
    {
        $incomesss = DB::table('user_incomes')->sum('amount');
        $expensess = DB::table('user_sub_categories')->sum('amount');
        DB::table('balances')->insert(
        ['total_income' => $incomesss, 'total_expenses' => $expensess , 'user_id' => Auth::user()->id ]
    );
    }
}
