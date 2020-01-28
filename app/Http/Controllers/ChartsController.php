<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\ExpenseSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartsController extends Controller
{
    public function charts(){
        $categories = ExpenseCategory::all();
          $subExpenses = Auth::User()->subExpenses;
         


        return view('charts.charts');
    }
}
