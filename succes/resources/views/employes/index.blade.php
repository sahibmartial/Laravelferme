@extends('layout.app')
@section('title')
<title>Employer</title>
@stop
@section('contenu')
<h2>{{$employes->count() }} Employer(s) </h2>
<ul>
	@if($employes->count()>0)
	@foreach($employes as $employe)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('employes.show',
		$employe)}}">{{ $employe->email}}</a></li>
	@endforeach
	@else
	<p>Aucune Campagne Enregistree !!! </p>
	@endif
</ul>
<p><a href="{{route('employes.create')}}">Enregister un employer</a>
</p>
@stop
@section('retour')
<a href="/ferme">Retour Menu Principale</a>
@stop