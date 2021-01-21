<?php 
//use App\Campagne;
use App\Http\Controllers\CampagneController;
//echo "string";
  //$var= $id->toJson();
$duredevie=0;
  ?>

@extends('base')
@section('title')
<title>VENTES</title>
@endsection
@section('content')
<div class="text-center mt-4">
<h2>Declarer une Vente</h2>
<form action="{{route('ventes.store')}}" method="POST">
	{{ csrf_field() }}
	{{--<input type="text" name="campagne_id" placeholder="Entrez ID " value={{ old('campagne_id') }}>
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}

    {{--<input type="date" name="date" placeholder="" value={{ old('date') }}>
     {!! $errors->first('date','<span class="error-msg">:message</span>') !!}
    <br>--}}
	<input type="text" name="campagne" placeholder="Entrez nom campagne " value={{ old('campagne') }}>
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
    <br>
	<input type="number" name="quantite" placeholder="Entrez la quantite vendue " value={{ old('quantite') }}>
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
  <br>
  
  <input type="number" name="priceUnitaire" placeholder="Prix Unitaire " value={{ old('priceUnitaire') }}>
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
  <br>
 {{  Form::label('acheteur', 'Acheteur: ')  }}
 {{ Form::select('acheteur', array('Particulier' => 'Particulier', 'Grossiste' => 'Grossiste'), 'Particulier')}}
  {{--<input type="text" name="acheteur" placeholder="Acheteur">--}}
	{!! $errors->first('acheteur','<span class="error-msg">:message</span>') !!}
	 <br>
  <input type="text" name="contact" placeholder="Contact">
	{!! $errors->first('contact','<span class="error-msg">:message</span>') !!}
	<br>
	 {{  Form::label('events', 'Events: ')  }}
	{{ Form::select('events', array('Party' => 'Party', 'Birdthay' => 'Birdthay','Death'=>'Death','Autres'=>'Autres'),'Autres') }}
	{{--<input type="text" name="events" placeholder="EVENTS">--}}
	{!! $errors->first('events','<span class="error-msg">:message</span>') !!}
	<br>
	<textarea name="obs" placeholder="Observations" ></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Enregister vente" class="btn btn-success">
</form>
<br>

<p><a href="{{route('ventes.index')}}">Liste ventes</a></p>
<hr>
<p><a href="/vente"> Retour menu principal </a></p>
</div>
@stop


