@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ $recipe->name }}<h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('recipes.form',[
                        'buttonText' => 'Update Recipe',
                        'formMethod' => 'PATCH',
                        'formPath'   => $recipe->path()
                    ])

                   

                    <h3 class="medium">Flavors</h3>
                    @if($recipe->flavors->count() !== 0)
                        @foreach($recipe->flavors as $flavor)
                            <span class="label label-default" style="background:"><a class="text-white" href="/flavors/{{ $flavor->id }}">{{$flavor->name}}</a></span>
                        @endforeach
                    @else

                        <div>There are currently no flavors being used by this recipe.</div>
                    
                    @endif
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
