<?php

// Authorization
Auth::routes();
 
// Authorized Routes
Route::group(['middleware' => 'auth'], function(){
    Route::get('/recipes/create', 'RecipesController@create');
    Route::post('/recipes', 'RecipesController@store');
    Route::patch('/recipes/{recipe}', 'RecipesController@update');
    Route::get('/recipes/{recipe}', 'RecipesController@show');
    Route::get('/recipes/{recipe}/edit', 'RecipesController@edit');
    
    
});

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/home', 'HomeController@index')->name('home');

// Recipes
Route::get('/recipes', 'RecipesController@index');
Route::get('/filter', "RecipesController@filter");

// Flavors
Route::get('/flavors', 'FlavorsController@index');
Route::get('/flavors/{flavor}', 'FlavorsController@show');



// Need to do something with these.
Route::get('/api/recipes', function(){
    return App\Recipe::with('flavors')->latest()->paginate(20);
});

Route::get('/api/flavors', function(){
    $flavors = App\Flavor::all();
    foreach($flavors as $key => $flavor) {
        $flavors[$key]['pivot'] = ["flavor_perc" => 0];  
    } 
    return $flavors;
});

Route::get('/api/users', function(){
    return App\User::all()->pluck('name', 'id');
  
});

