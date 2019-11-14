<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;


class RecipesController extends Controller
{


    protected $guarded = [];

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_user = auth()->user();

        return view('recipes.create', compact('current_user'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // $recipeList = Recipe::latest()
        //     ->where('flavors', 1)
        //     ->paginate(20);

        
        // $recipes = Recipe::withPivot('flavors')->get();


        // $recipes = Recipe::whereHas('flavors', function ($query) {
            // $query->where('flavor_id', 1);
        // })->get();

        // return $recipes;

        return view('recipes.index');

        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $owner = auth()->id();

        $recipe = Recipe::create([
            'name'  => request('name'),
            'description'   => request('description'),
            'owner_id'      => $owner,
        ]);

        $flavors = request('flavors');

        $recipe->flavors()->attach($flavors);
        

        return redirect($recipe->path());

    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {


        $recipe->update([
            'name'  => request('name'),
            'description'   => request('description')
        ]);

        $flavors = request('flavors');

        $recipe->flavors()->detach();

        $recipe->flavors()->attach($flavors);

        return redirect($recipe->path());


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        //
    }

     protected function validateRequest()
    {
        return request()->validate([
            'name' => 'sometimes|required', 
            'description' => 'sometimes|required',
        ]);
    }
}
