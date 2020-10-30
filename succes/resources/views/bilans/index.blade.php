@extends('layout.addmorealiments')
@section('title')
<title>BILAN</title>
@stop
@section('contenu')
<h2>{{$bilans->count() }} Bilan(s) </h2>
<ul>
	@if($bilans->count()>0)
	@foreach($bilans as $bilan)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('bilans.show',
		$bilan)}}">{{ $bilan->campagne}}</a></li>
	@endforeach
	</ul>
	@else
	<p>Aucun Bilan Enregistre !!! </p>
	@endif

{{--<p><a href="{{route('bilans.create')}}">creer une campagne</a>--}}
</p>
@stop
@section('retour')
<a href="/ferme">Retour Menu Principale</a>
@stop
@section('footer')
@include('layout.partials.footer')
@stop