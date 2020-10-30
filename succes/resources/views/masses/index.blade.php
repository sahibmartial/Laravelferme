@extends('layout.addmorealiments')
@section('title')
<title>Masse</title>
@stop

@section('contenu')
<ul>
	@if($masses->count()>0)
	@foreach($masses as $masse)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('masses.show',
		$masse)}}">{{ $masse->campagne}}</a></li>
	@endforeach
	@else
	<p>Aucun Enregistrement de masses disponible !!! </p>
	@endif
</ul>
<br>
<p><a href="{{route('masses.create')}}">Enregister une masse pour une campagne </a></p>
@stop

@section('retour')
<p><a href="/ferme"> Menu principal</a></p>
@endsection
@section('footer')
@include('layout.partials.footer')
@stop