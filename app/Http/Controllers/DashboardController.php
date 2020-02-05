<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
 
      $user = User::find(Auth::user() -> id);
      $sumIncome = 0;
      foreach($user -> user_incomes as $income) {
          $sumIncome = $sumIncome + floatval($income -> amount);
      }
      $sumExpense = 0;
      foreach($user ->subExpenses as $expense) {
          $sumExpense = $sumExpense + floatval($expense->pivot->amount);
      }
      return view('userHome', compact('sumIncome','sumExpense'));
}
    public function store(Request $request){
        $user = User::find(Auth::user()->id);
        $user->rate = $request->rate;
        $user->save();
        //dd($user);        
        return redirect()->route('userHome');
    }
}
