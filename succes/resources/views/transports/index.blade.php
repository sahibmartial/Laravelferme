@extends('layout.app')
@section('title')
<title>TRANSPORT</title>
@stop
@section('contenu')
<ul>
	@if($transports->count()>0)
	@foreach($transports as $transport)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('transports.show',
		$transport)}}">{{ $transport->campagne}}-{{ $transport->obs}}</a></li>
	@endforeach
	@else
	<p>Aucun  frais de transport  Enregistres pour une campagne !!! </p>
	@endif
</ul>
<br>
<p><a href="{{route('transports.create')}}">Enregister un frais de transport</a></p>
@stop

@section('retour')
<p><a href="/achats"> Retour Achats</a></p>
@stop