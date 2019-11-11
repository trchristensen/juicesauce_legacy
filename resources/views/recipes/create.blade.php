@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Create a Recipe</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Current User is {{$current_user->id}}

                    <createRecipe endpoint="/recipes"></createRecipe>

                    {{-- @include('recipes.form',[
                        'recipe'     => new App\Recipe,
                        'buttonText' => 'Create Recipe',
                        'formMethod' => 'POST',
                        'formPath'   => '/recipes'
                    ]) --}}
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
