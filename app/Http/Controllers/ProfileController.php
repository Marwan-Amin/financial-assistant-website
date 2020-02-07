<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use Auth;


class ProfileController extends Controller
{
    public function index() 
    {
        return view('profile.index');
    }

    public function edit() 
    {
        $countries = Country::all();
        return view('profile.edit',compact('countries'));
    }

    public function update(Request $request ,$id) 
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:rfc,dns'
        ]);
        
        $user = User::find($id);
        if( request()->avatar ){
            $path = request()->file('avatar')->store('upload');
            request()->avatar->move(public_path('upload'), $path);
            $user->name = request()->name;
            $user->email = request()->email;
            $user->gender = request()->gender;
            $user->age = request()->age;
            $user->country = request()->country;
            $user->city = request()->city;
            $user->avatar = $path;
            $user->save();
        }else{
           
            $user->name = request()->name;
            $user->email = request()->email;
            $user->gender = request()->gender;
            $user->age = request()->age;
            $user->country = request()->country;
            $user->city = request()->city;
            $user->avatar = Auth::user()->avatar;
            $user->save();


        }
        
        
        return redirect('user_profile')->with('message', 'updated successfuly');
        
    }
    public function getStates($countryName){
        $country = Country::where('name', $countryName)->first();
        $states=[];
        if($country){
        foreach($country->states as $state){
            $states[]=$state->name;
        }
        
            return response()->json($states);

        }else{
            return response()->json('fail');
        }
    }
}
