@extends('base')
@section('title')
<title>Error- Page</title>
@stop
@section('content')

<div class="text-center mt-4">
    
    <div class="alert alert-danger">
            <p>{{ $errors }}</p>
        </div>
    <hr>
    <a href="/ferme">Retour Menu Principale</a>
</div>
@stop
