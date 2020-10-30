@extends('layout.addmorealiments')
@section('title')
<title>CAMPAGNES</title>
@stop
@section('contenu')
<h2>{{$campagnes->count() }} Campagne(s) </h2>
<ul>
	@if($campagnes->count()>0)
	@foreach($campagnes as $campagne)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('campagnes.show',
		$campagne)}}">{{ $campagne->intitule}}</a></li>	
	@endforeach
    </ul>
	<div>
	{{ $campagnes->links() }}
    </div>
	@else
	<p>Aucune Campagne Enregistree !!! </p>
	@endif
<p><a href="{{route('campagnes.create')}}">creer une campagne</a>
</p>
@stop
@section('retour')
<a href="/ferme">Retour Menu Principale</a>
@stop
@section('footer')
@include('layout.partials.footer')
@stop