<?php

namespace App\Http\Controllers\Finance;

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
        $targetsData = Target::where('user_id', Auth::user()->id)->get();
            foreach ($targetsData as $target) {
                    $target->savings = $sumSaving;
                    $target->save();
            }
        return ($sumSaving);
    }

        
}
