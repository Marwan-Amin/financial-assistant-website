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
    return view('home.index');
});

Route::middleware(['auth','verified'])->group(function(){
    
    Route::get('/user/ajax/{countryName}','ProfileController@getStates')->name('user.ajax');
    Route::get('/home', 'HomeController@index')->name('home');
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

    //events route
    Route::get('/events/create', 'EventController@create')->name('events.create');
    Route::get('/events/manager', 'EventController@index')->name('events.index');
    Route::delete('/events/{id}/delete', 'EventController@destroy')->name('events.destroy');
    Route::get('/events/{id}','EventController@edit')->name('events.edit');
    Route::get('/events/{id}/show','EventController@show')->name('events.show');
    Route::put('/events/{id}/update','EventController@update')->name('events.update');
    Route::put('/SubEvents/{id}/update','EventController@updateSubEvent')->name('subEvent.update');
    Route::post('/events','EventController@store')->name('events.store');
    Route::post('/events/subExpenseEvent','EventController@storeSubEvent')->name('events.subStore');

    //savings routes
    Route::get('/savings/create', 'SavingController@index')->name('savings.create');
    Route::post('/savings','SavingController@store')->name('savings.store');
    Route::delete('/savings/{saving_id}', 'SavingController@destroy')->name('savings.destroy');
    Route::get('/savings/{saving_id}/edit', 'SavingController@edit')->name('savings.edit');
    Route::patch('/savings/{saving_id}', 'SavingController@update')->name('savings.update');

    //target routes
    Route::get('/targets/create', 'TargetController@index')->name('targets.create');
    Route::post('/targets','TargetController@store')->name('targets.store');
    Route::delete('/targets/{target_id}', 'TargetController@destroy')->name('targets.destroy');
    Route::get('/targets/{target_id}/edit', 'TargetController@edit')->name('targets.edit');
    Route::patch('/targets/{target_id}', 'TargetController@update')->name('targets.update');

    //user profile routes
    Route::get('/user_profile', 'ProfileController@index')->name('home');
    Route::get('/user_profile/{id}/edit', 'ProfileController@edit')->name('home');
    Route::put('/user_profile/{id}' , 'ProfileController@update' );

    //Reporting routes
    Route::get('/reports/index', 'ReportController@index')->name('reports.index');
    Route::post('/reports/index', 'ReportController@filter')->name('reports.filter');

    //prediction routes
    Route::get('/predictData', 'TensorFlowController@getBalanceData')->name('predict');
    Route::get('/predict', 'TensorFlowController@index')->name('predict.index');

    //Charts routes
    Route::get('/charts', 'ChartsController@charts')->name('charts');
    Route::post('/charts/subCategories', 'ChartsController@getSubCategoriesForCharts')->name('charts.subCategories');

    //blog routes
    // Route::get('/posts', 'PostController@index');
    // Route::get('/','PostController@index' );
    // Route::get('/posts/create', 'PostController@create');
    // Route::post('/posts', 'PostController@store');
    // Route::post('/posts/{id}', 'commentController@store');
    // Route::get('/posts/ajax/{id}', 'AjaxController@show');
    // Route::get('/posts/{id}', 'PostController@show')->name('posts.post');
    // Route::get('/posts/{id}/edit', 'PostController@edit')->name('posts.edit');
    // Route::put('/posts/{id}', 'PostController@update');
    // Route::delete('/posts/{id}', 'PostController@destroy');
    // Route::delete('/posts/softDelete/{id}', 'PostController@softDelete');
    // Route::get('/posts/restoreDeleted/{id}', 'PostController@restoreDeleted');

});


Route::get('/home', function () {
    return view('home.index');
});


Auth::routes(['verify'=>true]);


Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

 Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')    
        ->name('login.callback')
        ->where('driver', implode('|', config('auth.socialite.drivers')));



Route::get('/states/ajax/{countryName}','Auth\RegisterController@getStates')->name('ajax');

