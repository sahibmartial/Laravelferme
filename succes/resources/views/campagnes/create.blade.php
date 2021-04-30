<?php
$tarted=date("Y-m-d ");
//dd($tarted);
?>
@extends('base')
@section('title')
<title>CAMPAGNE</title>
@stop
@section('content')
<div >
	<p><a href="{{route('home')}}">Accueil</a></p>
</div>
<div class="text-center"> @include('shared.formcampagne')</div>

@stop

