@extends('layout.addmorealiments')
@section('title')
<title>ACHATS-POUSSINS</title>
@endsection
@section('contenu')
<ul>
	@if(count($poussins)>0)

	@foreach($poussins as $key => $campagne)
	<!--utilisation des routes -->
	<li><a href="{{route('poussins.show',$campagne->id)}}">{{ $campagne->campagne}}</a></li>
	@endforeach
	</ul>
	<div>
	{{$poussins->links()}}
    </div>
	@else
	<p>Aucune quantite de poussins Enregistres pour une campagne !!! </p>
	@endif

<br>
<p><a href="{{route('poussins.create')}}">Enregister une quantite de poussins</a></p>
@stop

@section('retour')
<p><a href="/achats"> Retour Menu Achats </a></p>
@endsection
@section('footer')
@include('layout.partials.footer')
@stop