<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saving;
use App\User;
use App\Target;
use Illuminate\Support\Facades\Auth;

class Target_saving
{
    public function sum_savings(){
        $user = User::find(Auth::user()->id);
        $sumSaving = 0;
        foreach($user->savings as $saving) {
        $sumSaving = $sumSaving + $saving->amount ;
        }
    return ($sumSaving);
    }
    public function Edit_target_savings($sumSaving){
        /*$user = User::find(Auth::user()->id);
        foreach($user->target as $target) {
        
        }
        return ($sumSaving);*/
    }
        
}
