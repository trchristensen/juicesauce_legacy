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

                {{-- {{ dd($recipe->flavors->pluck('pivot')) }} --}}
                    
                   <updaterecipe recipename="{{ $recipe->name }}" recipedescription="{{ $recipe->description }}" recipeflavors='@json($recipe->flavors)' endpoint="/recipes/{{ $recipe->id }}">
                   </updaterecipe>
                 

                  
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
