<?php

namespace App\Http\Controllers;

use App\CustomCategory;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use DB;
use App\UserIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreIncomeRequest;
use App\Income;
use App\User;

class CalendarController extends Controller
{
    public function index()
    {
     
        $user= User::find(Auth::user()->id);

            
            
        return view('calendar')->with('user',$user);

    }
}
