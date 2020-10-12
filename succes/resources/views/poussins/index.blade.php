@extends('layout.app')
@section('title')
<title>ACHATS-POUSSINS</title>
@endsection
@section('contenu')
<ul>
	@if($poussins->count()>0)
	@foreach($poussins as $campagne)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('poussins.show',
		$campagne)}}">{{ $campagne->campagne}}</a></li>
	@endforeach
	@else
	<p>Aucune quantite de poussins Enregistres pour une campagne !!! </p>
	@endif
</ul>
<br>
<p><a href="{{route('poussins.create')}}">Enregister une quantite</a></p>
@stop

@section('retour')
<p><a href="/achats">Achats</a></p>
@endsection
