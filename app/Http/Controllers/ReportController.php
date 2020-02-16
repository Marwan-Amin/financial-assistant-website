<?php

namespace App\Http\Controllers;

use App\Balance;
use App\CustomCategory;
use App\Target;
use App\User;
use App\UserIncome;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserSubCategory;
use App\Exports\UserIncomesExport;
use App\Exports\UserExpensesExport;
use App\Exports\UserIncomesFilterExport;
use App\Exports\UserExpensesFilterExport;  
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    public $dateto;
    public function index()
    {
        $userInfo = User::find(Auth::user()->id);
        $currentDate = Carbon::today()->toDateString();
        $expenses=$userInfo->subexpenses;
        $incomes=$userInfo->incomes;
        $events = $userInfo->CustomCategories;
        $currentBalance = Balance::orderBy('date','DESC')->where('user_id',Auth::user()->id)->first();
        $currentBalanceAmount = $currentBalance != null ?$currentBalance->balance:0;
        $userCharts = new User();
        $chartsInfo = $userCharts->charts();
        return view ('Reporting.index', [
            'user' => $userInfo , 
            'expenses' => $expenses,
            'incomes' => $incomes,
            'date' => $currentDate ,
            'events' => $events,
            'targets' => $userInfo->target,
            'chartsInfo' => $chartsInfo,
            'currentBalance'=>$currentBalanceAmount
        ]);
    }

    public function filter(Request $request)
    {   
        $user_info = User::find(Auth::user()->id);
        $selectedDate = $request->reportDate;
        session()->put('selectedDate',$selectedDate);
        $currentDate = Carbon::today()->toDateString();
        $currentBalance = Balance::where('user_id',Auth::user()->id)->where('date',$request->reportDate)->first();
        $currentBalanceAmount = $currentBalance != null?$currentBalance->balance:0;
        $expenses = UserSubCategory::where([
            "date" => $selectedDate , 
            "user_id" => $user_info->id
        ])->get();


        $incomes = UserIncome::where([
            "date" => $selectedDate , 
            "user_id" => $user_info->id
        ])->get();



        $events = CustomCategory::where([
            "date" => $selectedDate , 
            "user_id" => $user_info->id
        ])->get();

        $currentDate = Carbon::today()->toDateString();
        $userCharts = new User();
        $chartsInfo = $userCharts->charts($request->reportDate);
        return view ('Reporting.index', [
            'user' => $user_info , 
            'filterexpenses' => $expenses,
            'filterIncomes' => $incomes,
            'events' => $events,
            'targets' => $user_info->target,
            'date' => $selectedDate ,
            'currentDate' =>$currentDate,
            'events' => $events,
            'chartsInfo' => $chartsInfo,
            'currentBalance'=>$currentBalanceAmount
        ]);
    }

    public function incomeExport()
    {
        return Excel::download(new UserIncomesExport, 'incomes.xlsx');
    }

    public function expenseExport()
    {
        return Excel::download(new UserExpensesExport, 'expenses.xlsx');
    }

    public function filterIncomeExport()
    {
        return Excel::download(new UserIncomesFilterExport, 'filteredIncomes.xlsx');
    }

    public function filterExpenseExport()
    {
        return Excel::download(new UserExpensesFilterExport, 'filteredExpenses.xlsx');
    } 
}
