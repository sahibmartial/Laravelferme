@extends('base')
@section('title')
<title>Error- Page</title>
@stop
@section('content')

<div class="text-center mt-4">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <hr>
    <a href="/ferme">Retour Menu Principale</a>
</div>
@stop
