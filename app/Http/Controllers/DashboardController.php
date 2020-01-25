<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){
        $user = User::find(Auth::user()->id);
        $sumIncome = 0;
            foreach ($user->user_incomes as  $income) {
              $sumIncome =  $sumIncome + floatval($income->amount);
            }
            return view('userHome', compact('sumIncome'));
    }
}
