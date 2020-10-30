@extends('layout.addmorealiments')
@section('contenu')
<h1>Editer  Achat Poussins #{{ $poussin->id}}</h1>
<form action="{{route('poussins.update',$poussin)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<input type="text" name="campagne_id" placeholder="Entrez ID" value="{{ old('campagne_id')?? $poussin->campagne_id}}">
	
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="campagne" placeholder="Entrez votre titre" value="{{ old('campagne')?? $poussin->campagne}}">
	
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="quantite" cols="20" rows="10" placeholder="quantite" value=" {{old('quantite')?? $poussin->quantite}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="text" name="priceUnitaire" cols="20" rows="10" placeholder="priceUnitaire" value=" {{old('priceUnitaire')?? $poussin->priceUnitaire}}">
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer Achat Poussin">
</form>
<br>
@stop
@section('retour')
<p><a href="{{route('head')}}">Accueil Poussins</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop