@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ $flavor->name }}<h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="mb-4">{{ $flavor->description }}</p>

                    <h3>Recipes made with {{ $flavor->name }}</h3>
                    <ul>
                        @foreach( $flavor->recipes as $recipe )
                        <li>
                            <a href="{{ $recipe->path() }} ">
                            {{ $recipe->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
