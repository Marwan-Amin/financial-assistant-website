<?php

namespace App\Http\Controllers;

use App\CustomCategory;
use App\Target;
use App\User;
use App\UserIncome;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserSubCategory;
class ReportController extends Controller
{
    public function index()
    {
        $userInfo = User::find(Auth::user()->id);
        $currentDate = Carbon::today()->toDateString();
        $expenses=$userInfo->subexpenses;
        // dd($expenses);
        $incomes=$userInfo->incomes;
        $events = $userInfo->CustomCategories;
        return view ('Reporting.index', [
            'user' => $userInfo , 
            'expenses' => $expenses,
            'incomes' => $incomes,
            'currentDate' => $currentDate ,
            'events' => $events,
            'targets' => $userInfo->target,
        ]);
    }

    public function filter(Request $request)
    {   
        $user_info = User::find(Auth::user()->id);
        $selectedDate = $request->reportDate;
        
        $expenses = UserSubCategory::where([
            "date" => $selectedDate , 
            "user_id" => $user_info->id
        ])->get();

        // dd($expenses[0]);

        $incomes = UserIncome::where([
            "date" => $selectedDate , 
            "user_id" => $user_info->id
        ])->get();

        // dd($incomes[0]->income);


        $events = CustomCategory::where([
            "date" => $selectedDate , 
            "user_id" => $user_info->id
        ])->get();

        $currentDate = Carbon::today()->toDateString();
        // dd($events);
        return view ('Reporting.index', [
            'user' => $user_info , 
            'filterexpenses' => $expenses,
            'filterIncomes' => $incomes,
            'events' => $events,
            'targets' => $user_info->target,
            'selectedDate' => $selectedDate ,
            'currentDate' => $currentDate ,
            'events' => $events,
        ]);
    }
}
