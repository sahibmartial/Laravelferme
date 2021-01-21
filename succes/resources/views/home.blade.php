@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status') }}<br>
                            

                        </div>
                    @endif
                    
                    <p style="color:blue"><b>  {{ __('Vous etes connecté à la ferme Maya !') }}<b></p>

                    
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
