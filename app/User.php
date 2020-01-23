<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Income;
use App\ExpenseSubCategory;
use App\Balance;
use App\Target;
use App\Saving;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','gender','age','city','country'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'provider_name', 'provider_id', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function income()
    {
       return $this->belongsToMany(Income::class,'user_income','user_id','income_id');
    }

    public function subExpenses()
    {
       return $this->belongsToMany(ExpenseSubCategory::class,'user_sub_category','user_id','sub_category_id');
    }

    public function balance()
    {
        return $this->hasMany(Balance::class);
    }

    public function target()
    {
        return $this->hasMany(Target::class);
    }

    public function saving()
    {
        return $this->hasMany(Saving::class);
    }
}
