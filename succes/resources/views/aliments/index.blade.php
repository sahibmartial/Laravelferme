@extends('layout.app')
@section('title')
<title>Aliments</title>
@stop

@section('contenu')
<ul>
	@if($aliments->count()>0)
	@foreach($aliments as $aliment)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('aliments.show',
		$aliment)}}">{{ $aliment->campagne}}-{{ $aliment->libelle}}</a></li>
	@endforeach
	@else
	<p>Aucun Achat Aliments Enregistres pour une campagne !!! </p>
	@endif
</ul>
<br>
<p><a href="{{route('aliments.create')}}">Enregister un Achat Aliment </a></p>
@stop

@section('retour')
<p><a href="/achats"> Menu Achats</a></p>
@endsection