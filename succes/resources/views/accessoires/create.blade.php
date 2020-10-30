@extends('layout.addmorealiments')
<?php 
use App\Campagne;
use App\Http\Controllers\CampagneController;
  $result = array();
//echo "string";
$cam= new CampagneController();
 $id=$cam->getCampagneenCours();
  //$var= $id->toJson();
 // dump($id);
 for ($i=0; $i <$id->count(); $i++) { 
 	//dump($id[$i]->id);
 	 $result[]=$id[$i]->intitule;
 }

//echo "string";
$cam= new Campagne();
 $id=$cam::all();
  $var= $id->toJson();
  ?>
@section('title')
<title>ACHATS-ACCESSOIRES</title>
@endsection
@section('contenu')
<h1>Achat Accessoires</h1>
<form action="{{route('accessoires.store')}}" method="POST">
	{{ csrf_field() }}
	{{--<input type="text" name="campagne_id" placeholder="Entrez ID " value={{ old('campagne_id') }}>
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}
	<input type="text" name="campagne" placeholder="Entrez nom campagne " value={{ old('campagne') }}>
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
    <br>
	<input type="text" name="libelle" placeholder="Entrez libelle " value={{ old('libelle') }}>
	{!! $errors->first('libelle','<span class="error-msg">:message</span>') !!}
	<br>
  <input type="number" name="quantite" placeholder="Quantite " value={{ old('quantite') }}>
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="number" name="priceUnitaire" placeholder="Prix Unitaire " value={{ old('priceUnitaire') }}>
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
  <br>
  	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Enregister accessoires">
</form>
<p><a href="{{route('accessoires.index')}}">Lister Accessoires</a></p>
@stop
@section('retour')
<p><a href="/achats"> Retour Achats</a></p>
@endsection

@section('footer')
@include('layout.partials.footer')
@stop