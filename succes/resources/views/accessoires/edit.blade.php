@extends('layout.app')
@section('title')
<title>Accessoires</title>
@stop
@section('contenu')
<h1>Editer  Achat Accessoire #{{ $accessoires->id}}</h1>
<form action="{{route('accessoires.update',$accessoires)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<input type="text" name="campagne" placeholder="Entrez votre titre" value="{{ old('campagne')?? $accessoires->campagne}}">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="libelle" cols="20" rows="10" placeholder="libelle" value=" {{old('libelle')?? $accessoires->libelle}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="number" name="quantite" cols="20" rows="10" placeholder="quantite" value=" {{old('quantite')?? $accessoires->quantite}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="number" name="priceUnitaire" cols="20" rows="10" placeholder="priceUnitaire" value=" {{old('priceUnitaire')?? $accessoires->priceUnitaire}}">
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
	<br>
	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer Achat Accessoires">
</form>
@stop
@section('retour')
<p><a href="{{route('accessoires.index')}}">Accueil</a></p>
@stop