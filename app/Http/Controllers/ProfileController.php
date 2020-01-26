<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;

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
        $user = User::find($id);
        $user->name = request()->name;
        $user->email = request()->email;
        $user->gender = request()->gender;
        $user->age = request()->age;
        $user->country = request()->country;
        $user->city = request()->city;
        $user->save();
        return redirect('user_profile')->with('message', 'updated successfuly');
    }
}
