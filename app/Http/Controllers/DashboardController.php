<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Phpml\Regression\LeastSquares;

class DashboardController extends Controller
{
    public function index() {
        
        // $samples = [[73676,1, 1996], [70000,2, 1998]];
        // $targets = [2000, 9000];


        // $regression = new LeastSquares();
        // $regression->train($samples, $targets);
        // dd($regression->predict([0,7, 2025]));
      
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
        return response()->json($request->rate);
    }
}
