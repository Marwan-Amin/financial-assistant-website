<?php
use App\Country;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','verified'])->group(function(){
    
    Route::get('/states/ajax/{countryName}','Auth\RegisterController@getStates')->name('ajax');
    Route::get('/userHome',"DashboardController@index")->name('userHome');
    //incomes routes
    Route::get('/incomes','IncomeController@index')->name('incomes.index');
    Route::get('incomes/create', 'IncomeController@create')->name('incomes.create');
    Route::post('/incomes','IncomeController@store');
    Route::delete('/incomes/{income_id}', 'IncomeController@destroy')->name('incomes.destroy');
    Route::patch('/incomes/{income_id}', 'IncomeController@update')->name('incomes.update');
    Route::get('/incomes/{income_id}/edit', 'IncomeController@edit')->name('incomes.edit');


    //expenses routes
    Route::get('/expenses/create', 'ExpenseController@create')->name('expenses.create');
    Route::get('/expenses/index','ExpenseController@index')->name('expenses.index');
    Route::post('/expenses','ExpenseController@store')->name('expenses.store');
    Route::get('/category/ajax/{categoryId}','ExpenseController@getSubCategories')->name('subCategory.ajax');
    Route::get('/expenses/{id}','ExpenseController@create')->name('expenses.edit');
    Route::put('/expenses/{id}','ExpenseController@edit')->name('expenses.edit');

    Route::delete('/expenses/{id}', 'ExpenseController@destroy')->name('expenses.destroy');




    //savings routes
    Route::get('savings/create', 'SavingController@create')->name('savings.create');
    Route::post('/savings/create','SavingController@store');

});


Route::get('/home', function () {
    return view('home.index');
});


Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth','verified']);

Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

 Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')    
        ->name('login.callback')
        ->where('driver', implode('|', config('auth.socialite.drivers')));
