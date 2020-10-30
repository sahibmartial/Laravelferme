<?php
//$index=$campagnes->id;
?>
@extends('layout.app')
@section('title')
<title>CAMPAGNE</title>
@stop
@section('contenu')
{{--
<h2>Info Employer</h2>
<p>{{ $employes->name}}</p>
<p>{{ $employes->email}}</p>
--}}

@include('shared.show_employe')
<p><a href="{{ route('employes.edit', $employes)}}">Modifier Employer</a></p>

<form action="{{route('employes.destroy',$employes)}}" method="POST"
 onsubmit="return confirm('Etes-vous sure?');" 
 >
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<p><a href="{{route('home')}}">Accueil</a></p>
@stop


