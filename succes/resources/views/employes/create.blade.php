<?php
$tarted=date("Y-m-d ");
//dd($tarted);
?>
@extends('layout.app')
@section('title')
<title>Employer</title>
@stop
@section('contenu')
@include('shared.formeployer')
@stop
@section('retour')
<p><a href="{{route('home')}}">Accueil</a></p>
@stop