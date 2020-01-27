<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TargetController extends Controller
{
    function create (){
        return view('targets.create'); 
    }
}
