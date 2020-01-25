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
    
    
    Route::get('/userHome', function () {
        return view('userHome');
    });

    Route::get('/incomes','IncomeController@index')->name('incomes');

    Route::post('/incomes','IncomeController@store');

    Route::delete('/incomes/{income}', 'IncomeController@destroy')->name('incomes.destroy');


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
Route::get('/states/ajax/{countryName}','Auth\RegisterController@getStates')->name('ajax');
