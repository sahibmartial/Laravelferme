<?php
$tarted=date("Y-m-d ");
//dd($tarted);
?>
@extends('layout.app')
@section('title')
<title>CAMPAGNE</title>
@stop
@section('contenu')
@include('shared.formcampagne')
@stop
@section('retour')
<p><a href="{{route('home')}}">Accueil</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop