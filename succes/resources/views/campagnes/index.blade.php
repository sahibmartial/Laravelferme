@extends('shared.ferme')
@section('contenu')
<h1>{{$campagnes->count() }} Campagne(s) </h1>
<ul>
	@if($campagnes->count()>0)
	@foreach($campagnes as $campagne)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('campagnes.show',
		$campagne)}}">{{ $campagne->intitule}}</a></li>
	@endforeach
	@else
	<p>Aucune Campagne Enregistree !!! </p>
	@endif
</ul>
<br>
<p><a href="{{route('campagnes.create')}}">creer une campagne</a></p>
@stop