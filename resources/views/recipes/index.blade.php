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

                @if($recipeList)

                @foreach($recipeList as $recipe)
                <div class="list-item mb-2 pl-2 pr-2 pt-2 pb-4" style="border-bottom:1px solid #efefef;">
                    <div class="header d-flex">
                        <div class="ml-0 mr-auto">
                            <a style="text-decoration:none;color:#212529;font-size:22px" href="{{ $recipe->path() }}">{{ $recipe->name }}</a>
                        </div>
                        <div style="float:right">
                            <a style="text-decoration:none;color:#212529;font-size:12px;font-style:italic" href="{{ $recipe->path() }}">{{ \Carbon\Carbon::parse($recipe->created_at)->diffForHumans() }}</a>
                        </div>
                    </div>
                    <div class="mb-2">
                    <a style="text-decoration:none;color:#212529;" href="{{ $recipe->path() }}">{{ Str::limit($recipe->description, 100) }}</a>
                    </div>
                    <div>
                    @foreach($recipe->flavors as $flavor)
                        
                        <span class="label label-default" style="background:">{{$flavor->name}}</span>
                    @endforeach
                    </div>
                </div>

                @endforeach
                        <div class="d-flex align-center justify-content-center mt-5">{{ $recipeList->links() }}</div>
                   
                @endif

                    
                   
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
