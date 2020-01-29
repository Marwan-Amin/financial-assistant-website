<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Saving
use App\User;
use App\Target;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Target_saving;

class TargetController extends Controller
{
    function index() 
    {
        $user_id = Auth::user()->id; 
        //$targets = user::find(Auth::user()->id)->target()->get(); 
        return view('targets.create',[
        'targets' => user::find(Auth::user()->id)->target()->get()
        ]);
    }
    
    function store(Request $request)
    {
      //return response()->json($request); //ajax dd :D
        $saving=new Target_saving;
        $savings=$saving->sum_savings();
        //return response()->json($savings);
        $target = Target::create([
        'target_amount' => $request->target_amount,
        'target_name' => $request->target_name ,
        'savings' => $savings,
        'user_id' => Auth::user()->id
        ]);
        return response()->json($target);
    }

    function destroy($target_id)
    {
        $target = Target::findOrFail($target_id);
        $target->delete();
        return response()->json($target);
    }

    function update($target_id,Request $request)
    {
        $target = target::findOrFail($target_id);
        $target->target_amount = $request->target_amount;
        $target->target_name = $request->target_name;
        $target->save();
        return redirect()->route('targets.create');
    }
    function edit($target_id)
    {
        $target = target::find($target_id);
        return view('targets.edit',[
            'target' => $target 
        ]);
        
    }
}