@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Flavors</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                @if($flavorList)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($flavorList as $flavor)
                            
                                
                                    <tr>
                                    <td><a href="#">{{ $flavor->name }}</a></td>
                                    
                                    </tr>
                                
                        
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                    
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
