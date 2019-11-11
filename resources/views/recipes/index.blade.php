@extends('layouts.app')

@section('content')
<div class="container">



    <div>
        <div class="row justify-content-center">
            <div class="col-md-10 d-flex align-items-center">
                <div class="mr-auto ml-0">
                <h2>Recipes</h2>
                </div>
                    <div class="ml-auto mr-0 pt-2 pb-2 pr-0 mb-4">
                        <a class="btn btn-success" href="/recipes/create">Create Recipe</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

               <recipeindex></recipeindex>
                    
                   
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
