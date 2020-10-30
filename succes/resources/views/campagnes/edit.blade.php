<?php
$tarted=date("Y-m-d ");
//dd($tarted);
?>
@extends('layout.addmorealiments')
@section('title')
<title>CAMPAGNE</title>
@stop
@section('contenu')
@include('shared.campagne_edit')
@stop
<br>
@section('retour')
<p><a href="{{route('home')}}">Accueil</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop
@section('footer')
@include('layout.partials.footer')
@stop