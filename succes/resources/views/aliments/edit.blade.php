@extends('base')
@section('title')
<title>ALIMENTS</title>
@stop

@section('content')
<div class="text-center mt-4">
	
@include('shared.editaliment')
<p class="mt-2"><a href="{{route('aliments.index')}}">Listing Aliments</a></p>
</div>

@stop
