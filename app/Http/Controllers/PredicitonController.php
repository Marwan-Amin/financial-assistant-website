<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PredicitonController extends Controller
{
    public function index()
    {
        
        return view ('prediction');
    }
     public function getPredictionData(Request $request)
    {
        return response()->json($request);
    }
}
