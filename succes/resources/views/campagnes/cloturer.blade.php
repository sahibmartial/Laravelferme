@extends('base')
@section('title')
<title>CAMPAGNE</title>
@stop
@section('content')
<div class="text-center mt-2 mb-5">
	@include('shared.cloture_campagne')
</div>
<p><a href="{{route('home')}}">Accueil</a></p>
@stop



