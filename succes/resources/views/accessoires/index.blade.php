@extends('layout.app')
@section('title')
<title>Accessoires</title>
@stop

@section('contenu')
<ul>
	@if($accessoires->count()>0)
	@foreach($accessoires as $accessoire)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('accessoires.show',
		$accessoire)}}">{{ $accessoire->campagne}}-{{ $accessoire->libelle}}</a></li>
	@endforeach
	@else
	<p>Aucun Accessoires Enregistres pour une campagne !!! </p>
	@endif
</ul>
<br>
<p><a href="{{route('accessoires.create')}}">Enregister un accessoire</a></p>
@stop

@section('retour')
<p><a href="/achats">Achats</a></p>
@endsection
