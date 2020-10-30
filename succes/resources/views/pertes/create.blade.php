<?php 
//use App\Campagne;
use App\Http\Controllers\CampagneController;
//echo "string";
  //$var= $id->toJson();
$duredevie=0;

  ?>
@extends('layout.addmorealiments')
@section('title')
<title>PERTES</title>
@endsection
@section('contenu')
<h2>Declarer une Perte</h2>
<form action="{{route('pertes.store')}}" method="POST">
	{{ csrf_field() }}

	{{--<input type="text" name="campagne_id" placeholder="Entrez ID " value={{ old('campagne_id') }}>
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}
	<input type="text" name="campagne" placeholder="Entrez nom campagne " value={{ old('campagne') }}>
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
    <br>
	<input type="number" name="quantite" placeholder="Entrez la quantite de pertes " value={{ old('quantite') }}>
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
  <br>
  {{--
  <input type="number" name="priceUnitaire" placeholder="Prix Unitaire " value={{ old('priceUnitaire') }}>
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="text" name="fournisseur" placeholder="Fournisseur">
	{!! $errors->first('fournisseur','<span class="error-msg">:message</span>') !!}
	--}}
	<textarea name="cause" placeholder="CAUSES"></textarea>
	{!! $errors->first('cause','<span class="error-msg">:message</span>') !!}
	<br>
	<textarea name="obs" placeholder="Suggestions en cas de edit" disabled></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Enregister quantite">
</form>
<br>
<p><a href="{{route('pertes.index')}}">Liste pertes</a></p>
@stop

@section('retour')
<p><a href="/perte"> Retour menu principal </a></p>
@endsection
@section('footer')
@include('layout.partials.footer')
@stop