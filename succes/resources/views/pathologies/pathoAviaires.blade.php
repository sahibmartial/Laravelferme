@extends('base')
@section('title')
<title>Pathologies Aviares</title>
@endsection
@section('content') 
<div class="text-center mt-4">
@include('shared.pathoAviaires')
<hr>
<p><a href="/ferme"> Retour Board</a></p>
</div>
@stop