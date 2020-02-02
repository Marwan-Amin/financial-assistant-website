<?php

namespace App\Http\Controllers;
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
        return view('calendar', [
            'user' => User::find(Auth::user()->id)
        ]);

    }
}
