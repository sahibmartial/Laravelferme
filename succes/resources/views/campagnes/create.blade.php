<?php
$tarted=date("Y-m-d ");
//dd($tarted);
?>
@extends('shared.ferme')
@section('contenu')
<h1>Creer une campagne</h1>
<form action="{{route('campagnes.store')}}" method="POST">
	{{ csrf_field() }}
	<input type="text" name="title" placeholder="Entrez nom campagne " value={{ old('title') }}>
	{!! $errors->first('title','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="text" name="status" placeholder="" value="EN COURS">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Creer">
</form>
<p><a href="{{route('home')}}">Accueil</a></p>
@stop