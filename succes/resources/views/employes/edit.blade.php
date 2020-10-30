<?php
$tarted=date("Y-m-d ");
//dd($tarted);
?>
@extends('layout.app')
@section('title')
<title>EMPLOYER</title>
@stop
@section('contenu')
@include('shared.edit_employe')
@stop
@section('retour')
<p><a href="{{route('home')}}">Accueil</a></p>
@stop