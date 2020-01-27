<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Saving
use App\User;
use Illuminate\Support\Facades\Auth;

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
        /*//return response()->json($request); //ajax dd :D
        $saving = Saving::create([
        'amount' => $request->saving_amount,
        'user_id' => Auth::user()->id
    ]);
    return response()->json($saving);*/
    }

    function destroy($target_id)
    {
        /*$saving = Saving::findOrFail($saving_id);
        $saving->delete();
        return response()->json($saving);*/
    }

    function update($target_id,Request $request)
    {
        /*$saving = Saving::findOrFail($saving_id);
        $saving->amount = $request->amount;
        $saving->save();
        return redirect()->route('savings.create');*/
    }
    function edit($target_id)
    {
        /*$saving = Saving::find($saving_id);
        return view('savings.edit',[
            'saving' => $saving 
        ]); */
        
    }
}
