<?php
/*use App\Http\Controllers\VenteController;
$vente= new VenteController();
$result=$vente->calculateVenteOfCampagne(1);*/
 //  echo $result;
?>
@extends('layout.addmorealiments')
@section('title')
<title>Vente</title>
@stop
@section('contenu')
<ul>
	@if($ventes->count()>0)
	@foreach($ventes as $vente)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('ventes.show',
		$vente->id)}}">{{ $vente->campagne}}-{{ $vente->obs}}</a></li>
		
	@endforeach
	</ul>
	<div>
		{{$ventes->links()}}
	</div>
	@else
	<p>Aucune Vente  Enregistree pour une campagne En cours !!! </p>
	@endif

<br>
<p><a href="{{route('ventes.create')}}">Enregister une Vente</a></p>
@stop

@section('retour')
<p><a href="/ferme">Menu Principal</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop