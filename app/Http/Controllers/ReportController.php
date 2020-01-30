<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $userInfo = User::find(Auth::user()->id);
        $currentDate = Carbon::today()->toDateString();
        // dd($userInfo->customCategories[1]->customSubCategories[0]->amount);
        return view ('Reporting.index', [
            'user' => $userInfo , 
            'expenses' => $userInfo->subexpenses,
            'date' => $currentDate ,
            'custom_categories' => $userInfo->CustomCategories
        ]);
    }
}
