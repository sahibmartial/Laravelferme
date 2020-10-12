<?php
$tarted=date("Y-m-d ");
//dd($tarted);
?>
@extends('layout.app')
@section('title')
<title>CAMPAGNE</title>
@stop
@section('contenu')
<h1>Editer campagne #{{ $campagnes->id}}</h1>
<form action="{{route('campagnes.update',$campagnes)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<input type="text" name="title" placeholder="Entrez votre titre" value="{{ old('title')?? $campagnes->intitule}}">
	
	{!! $errors->first('title','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="status" cols="20" rows="10" placeholder="Entre le statut" value=" {{old('status')?? $campagnes->status}}">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer la campagne">
</form>
@stop
@section('retour')
<p><a href="{{route('home')}}">Accueil</a></p>
@stop