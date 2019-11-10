<?php

namespace App\Http\Controllers;

use App\Flavor;
use Illuminate\Http\Request;

class FlavorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Flavor $flavor) {

        $flavorList = Flavor::latest()->get();

        return view('flavors.index', compact('flavorList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flavor  $flavor
     * @return \Illuminate\Http\Response
     */
    public function show(Flavor $flavor)
    {
        return view('flavors.show', compact('flavor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flavor  $flavor
     * @return \Illuminate\Http\Response
     */
    public function edit(Flavor $flavor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flavor  $flavor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flavor $flavor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flavor  $flavor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flavor $flavor)
    {
        //
    }
}
