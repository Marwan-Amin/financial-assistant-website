<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Saving
use App\User;
use App\Target;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Target_saving;
use Illuminate\Support\Facades\Validator;
class TargetController extends Controller
{
    function index() 
    {

        $saving=new Target_saving;
        $savings=$saving->sum_savings(); 
        // dd($targets = user::find(Auth::user()->id)->target);
        //$targets = user::find(Auth::user()->id)->target()->get(); 
        return view('targets.create',[
        'targets' => user::find(Auth::user()->id)->target()->get(),
        'savings' => $savings
        ]);
    }
    
    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'target_name' => 'required|unique:targets',
            'target_amount' => 'required',
        ]);
        if ($validator->passes()) {
      //return response()->json($request); //ajax dd :D
        $saving=new Target_saving;
        $savings=$saving->sum_savings();
        //return response()->json($savings);
        $target = Target::create(
        ['user_id' => Auth::user()->id,'target_name' => $request->target_name ,  
        'target_amount' => $request->target_amount,
        'savings' => $savings,       
        ]);
        $target = Target::find($target->id);
        
            return response()->json(['success'=>'Budget Goal is added Successfully.','targetData'=>$target]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);  
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