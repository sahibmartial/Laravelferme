@extends('base')

@section('title')
<title>Apport</title>
@stop
	
@section('content')

<div class="text-center mt-5 mb-3">
	@include('shared.apport_edit')
</div>
<p class="btn btn-info mb-5 float-right"><a href="{{route('apports.index')}}">Accueil</a></p>
@stop
