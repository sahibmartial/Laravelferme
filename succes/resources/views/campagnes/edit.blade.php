<?php
$tarted=date("Y-m-d ");
//dd($tarted);
?>
@extends('base')

@section('title')
<title>CAMPAGNE</title>
@stop
	
@section('content')

<div class="text-center mt-5 mb-3">
	@include('shared.campagne_edit')
</div>
<p class="btn btn-info mb-5 float-right"><a href="{{route('campagnes.index')}}">Accueil</a></p>
@stop


