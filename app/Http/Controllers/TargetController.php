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
        // dd($targets = user::find(Auth::user()->id)->target);
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
        $amount = Target::where('user_id',Auth::user()->id)->where('target_name',$request->target_name);
        $oldTargetAmount = $amount->exists()?$amount->first():['target_amount'=>0];
        $target = Target::updateOrCreate(
            ['user_id' => Auth::user()->id,'target_name' => $request->target_name ],
            [
        'target_amount' => $request->target_amount+$oldTargetAmount['target_amount'],
        'savings' => $savings,       
        ]);
        $target = Target::find($target->id);
        if($oldTargetAmount['target_amount'] == 0){
            $isUpdated = false;
            return response()->json(['targetData'=>$target,'isUpdated'=>$isUpdated]);
        }
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