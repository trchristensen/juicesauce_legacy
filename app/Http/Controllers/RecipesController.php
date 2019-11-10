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
        return view('recipes.create');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Recipe $recipe) {

        $recipeList = Recipe::latest()->paginate(20);

        return view('recipes.index', compact('recipeList'));
    }


   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);

        $recipe = Recipe::create([
            'name'  => request('name'),
            'description'   => request('description')
        ]);

        $flavors = request('flavors');

        $recipe->flavors()->detach();

        $recipe->flavors()->attach($flavors);

        

        // foreach ($flavors as $flavor) {
        //     $recipe->flavors()->attach([
        //         $flavor->id => ['flavor_perc' => $flavor->flavor_perc]
        //     ]);
        // }

        


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

        foreach (request('flavors') as $flavor) {
            $recipe->flavors()->sync([
                $flavor->id => ['flavor_perc' => $flavor->flavor_perc]
            ]);
        }

        // $recipe->flavors()->sync([
        //     1 => ['flavor_perc' => 4],
        //     2 =>['flavor_perc' => 3],
        //     3 =>['flavor_perc' =>3],
        //     ]);


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
