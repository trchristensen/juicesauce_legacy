@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8 d-flex">
            <div class="mr-auto ml-0 pt-2 pb-2 pr-0 mb-4" style="width:100%;">
                <div class="" style="display:flex;justify-content:space-between;">
                    <a style="margin-left:0;margin-right:auto;" href="/recipes">back</a>
                        <div style="margin-left:auto; margin-right:0">
                            <a href="{{ $recipe->path() }}/edit">edit</a>
                            
                        </div>
                </div>
            </div>
        </div>
    </div>


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

                        <p class="mb-4">{{ $recipe->description }}</p>

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
       

</div>
@endsection
 