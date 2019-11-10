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

// Flavors
Route::get('/flavors', 'FlavorsController@index');
Route::get('/flavors/{flavor}', 'FlavorsController@show');


Route::get('/api/flavors', function(){
    

    return App\Flavor::all();

});
