@extends('shared.ferme')
@section('contenu')
<h1>Editer  Achat Poussins #{{ $poussin->id}}</h1>
<form action="{{route('poussins.update',$poussin)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<input type="text" name="campagne" placeholder="Entrez votre titre" value="{{ old('campagne')?? $poussin->campagne}}">
	
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="quantite" cols="20" rows="10" placeholder="quantite" value=" {{old('quantite')?? $poussin->quantite}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer Achat Poussin">
</form>
<p><a href="{{route('head')}}">Accueil</a></p>
@stop