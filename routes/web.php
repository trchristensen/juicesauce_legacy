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

Route::get('/api/recipes', function(){
    
    return App\Recipe::with('flavors')->latest()->paginate(20);

});



Route::get('/api/recipes/flavor/{flavorID}', function($flavorID){
    

    return App\Recipe::whereHas('flavors', function ($query) use ($flavorID) {

        $query->where('flavor_id', $flavorID);

    })->paginate(20);
});


Route::get('/filter', function(Request $request){

    $query = request()->query();
    
    // if owner param
    if(request()->has('owner')){
        $ownerID = request()->query('owner');
    } else {
        $ownerID = null;
    }

    // if flavor params
    if(request()->has('flavor')){
         $flavorId = request()->query('flavor');
    } else {
        $flavorId = null;
    }
     

    return App\Recipe::with('flavors')
    ->where('owner_id', $ownerID)
    ->whereHas('flavors', function ($query) use ($flavorId) {
            $query->whereIn('flavor_id', $flavorId);
        })
    ->paginate(20);
    
});


Route::get('/recipeflavors', function(){
    return App\Recipe::with('flavors')->get();
});



// Flavors
Route::get('/flavors', 'FlavorsController@index');
Route::get('/flavors/{flavor}', 'FlavorsController@show');


Route::get('/api/flavors', function(){
    $flavors = App\Flavor::all();
    foreach($flavors as $key => $flavor) {
        $flavors[$key]['pivot'] = ["flavor_perc" => 0];  
    } 
    return $flavors;
});



