@extends('layout.app')
<?php 
use App\Campagne;
//echo "string";
$cam= new Campagne();
 $id=$cam::all();
  $var= $id->toJson();
  ?>
@section('title')
<title>ACHATS-POUSSINS</title>
@endsection
@section('contenu')
<h1>Achat de poussins</h1>
<form action="{{route('poussins.store')}}" method="POST">
	{{ csrf_field() }}
	<input type="text" name="campagne" placeholder="Entrez nom campagne " value={{ old('campagne') }}>
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
    <br>
	<input type="number" name="quantite" placeholder="Entrez la quantite " value={{ old('quantite') }}>
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="number" name="priceUnitaire" placeholder="Prix Unitaire " value={{ old('priceUnitaire') }}>
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="text" name="fournisseur" placeholder="Fournisseur">
	{!! $errors->first('fournisseur','<span class="error-msg">:message</span>') !!}
	<br>
	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Enregister quantite">
</form>
<p><a href="{{route('poussins.index')}}">Lister achats poussins</a></p>
@stop

@section('retour')
<p><a href="/achats"> Retour Achats</a></p>
@endsection