@extends('layout.addmorealiments')
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
		$accessoire->id)}}">{{ $accessoire->campagne}}-{{ $accessoire->libelle}}</a></li>
	@endforeach
	</ul>
	<div>
		{{$accessoires->links()}}
	</div>
	@else
	<p>Aucun Accessoires Enregistres pour une campagne !!! </p>
	@endif

<br>
<p><a href="{{route('accessoires.create')}}">Enregister un accessoire</a>
	/ <a href="{{route('get_all_accesoires')}}">All_Accesoires for_this_campagne</a>
</p>
@stop

@section('retour')
<p><a href="/achats">Retour Achats</a></p>
@endsection
@section('footer')
@include('layout.partials.footer')
@stop