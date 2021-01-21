<?php
$tarted=date("Y-m-d ");
//dd($tarted);
?>
@extends('base')
@section('title')
<title>Employer</title>
@stop
@section('content')
<div class="text-center mt-4">
@include('shared.formeployer')
<hr>
<p><a href="{{route('home')}}">Accueil</a></p>
</div>
@stop
