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
use App\UserSubCategory;
use App\UserIncome;
use App\CustomCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Command\ListCommand\GlobalVariableEnumerator;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

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
    public function user_incomes(){
        return $this->hasMany(UserIncome::class,'user_id');

    }
    public function incomes()
    {
       return $this->belongsToMany(Income::class,'user_incomes','user_id','income_id')->withPivot('user_id', 'Date','amount');

    }
    public function blogs(){
        return $this->hasMany(Blog::class,'user_id');

    }
    public function subExpenses()
    {
       return $this->belongsToMany(ExpenseSubCategory::class,'user_sub_categories','user_id','sub_category_id')->withPivot('amount','date','id');
    }
    
    public function balance()
    {
        return $this->hasMany(Balance::class);
    }

    public function target()
    {
        return $this->hasMany(Target::class);
    }

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }

    public function customCategories()
    {
        return $this->hasMany(CustomCategory::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function getUserExpenses($date = null){
        $arithmetic= $date?'=':'!=';
        $totalExpenses = DB::table('user_sub_categories')
        ->select('expense_categories.name as Category_Name', DB::raw('SUM(user_sub_categories.amount) as total'))
        ->join('expense_sub_categories', 'expense_sub_categories.id', '=', 'user_sub_categories.sub_category_id')
        ->join('expense_categories', 'expense_sub_categories.category_id', '=', 'expense_categories.id')
        ->join('users', 'user_sub_categories.user_id', '=', 'users.id')
        ->groupBy('expense_categories.name')
        ->where('users.id','=',Auth::user()->id)
        ->where('user_sub_categories.date',$arithmetic,$date)
        ->get()->toArray();
        $totalCustomExpenses = DB::table('custom_sub_categories')
        ->select('custom_categories.name as Custom_Category_Name', DB::raw('SUM(custom_sub_categories.amount) as custom_total'))
        ->join('custom_categories', 'custom_categories.id', '=', 'custom_sub_categories.category_id')
        ->join('users', 'custom_categories.user_id', '=', 'users.id')
        ->groupBy('custom_categories.name')
        ->where('users.id','=',Auth::user()->id)
        ->where('custom_categories.date',$arithmetic,$date)
        ->get()->toArray();
        $expensesArray = ['totalExpenses'=>$totalExpenses,'totalCustomExpenses'=>$totalCustomExpenses];
        return $expensesArray;
    }
    public function getUserBalancesByDate($date = null){
        global $dateFormate;
         $dateFormate = $date?'Y-m-d':'Y-m';
        $year = $date?Carbon::createFromFormat('Y-m-d', $date)->year:date('Y');
        $month = $date?Carbon::createFromFormat('Y-m-d', $date)->month:null;
        $userBalanceInfo = $month?
        Balance::select('balance as balance', 'date')
        ->whereYear('Date', $year)->whereMonth('Date',$month)
        :Balance::select('balance as balance', 'date')
        ->whereYear('Date', $year);
       $userBalanceInfo = $userBalanceInfo->where('user_id','=',Auth::user()->id)
        ->get()
        ->groupBy(function($result) {
            
        return Carbon::parse($result->date)->format($GLOBALS['dateFormate']); // grouping by years and its month
        })->toArray();

        $userBalanceByDate = [];
        foreach($userBalanceInfo as $index=>$balance){
            $userBalanceByDate[]=['date'=>$index,'totalAmount'=>array_sum(array_column($userBalanceInfo[$index],'balance'))];
        }
        // dd(Auth::user()->id);
        return $userBalanceByDate;
        
    }
    
    public function getUserIncome($date = null){
        $arithmetic= $date?'=':'!=';
        $totalIncome = DB::table('user_incomes')
        ->select('incomes.type as type', DB::raw('SUM(user_incomes.amount) as total'))
        ->join('incomes', 'incomes.id', '=', 'user_incomes.income_id')
        ->join('users', 'user_incomes.user_id', '=', 'users.id')
        ->groupBy('incomes.type')
        ->where('users.id','=',Auth::user()->id)
        ->where('user_incomes.date',$arithmetic,$date)
        ->get();
        return $totalIncome;
    }
    public function charts($date =null){
        //get all categories which belongs to user or user has customize it
        $subCategories = Auth::user()->subExpenses;
        $customCategories = Auth::user()->customCategories;
        $userCategories = [];
       if(count($customCategories) > 0 || count($subCategories) >0 ){
        if(count($subCategories) > 0){
            foreach($subCategories as $subCategory){
                $userCategories[]=['categoryName'=>$subCategory->category->name,'category_id'=>$subCategory->category->id,'isCustom'=>'false'];
            }
        }
        if(count($customCategories) > 0){
            foreach($customCategories as $customCategory){
                $userCategories[]=['categoryName'=>$customCategory->name,'category_id'=>$customCategory->id,'isCustom'=>'true'];
           }
        }
        
       }else{
           $userCategories=['categoryName' => 'there is no category created','category_id'=>0,'isCustom'=>'false'];
       }
       
        //start expense array for chart
        $totalExpenses = $this->getUserExpenses($date)['totalExpenses'];
        $totalCustomExpenses = $this->getUserExpenses($date)['totalCustomExpenses'];
        //end sub-expense for chart


        //start income array for chart
        $totalIncome = $this->getUserIncome($date);
        // dd($totalIncome);
        //end income array for chart
       $userChartInfo = [  'totalExpenses' => $totalExpenses ,
       'totalIncome' => $totalIncome ,
       'totalCustomExpenses'=>$totalCustomExpenses,
       'userCategories'=>$userCategories,
       'userIncomeByDate'=>$this->getUserBalancesByDate($date)
    ];
        return $userChartInfo;
    }

    public function getUserNameAttribute()
    {
        return $this->attributes['user_name'] == 'yes';
    }
}
