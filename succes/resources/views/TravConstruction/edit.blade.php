@extends('base')
@section('title')
<title>Travaux</title>
@stop
	
@section('content')

<div class="text-center mt-5 mb-3">
	@include('shared.Travaux_edit')
</div>
<p class="btn btn-info mb-5 float-right"><a href="{{route('travauxconstruction.index')}}">Liste materiel</a></p>
@stop

