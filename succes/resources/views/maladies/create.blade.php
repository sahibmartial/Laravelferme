@extends('base')
@section('title')
   <title>CAS-MALADIE</title>
@endsection

@section('content') 
    <div class="container text-center">
        @include('shared.maladie_form_create')
    </div>

    <p><a href="/OutilsCampagne"> Retour </a></p>
@stop