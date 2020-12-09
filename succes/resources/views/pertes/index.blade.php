@extends('layout.addmorealiments')
@section('title')
<title>PERTES</title>
@endsection
@section('contenu')
<ul>
	@if($pertes->count()>0)
	@foreach($pertes as $campagne)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('pertes.show',
		$campagne->id)}}">{{ $campagne->campagne}}-{{$campagne->cause}}</a></li>
	@endforeach
	</ul>
	<div>
		{{$pertes->links()}}
	</div>
	@else
	<p>Aucune quantite de pertes Enregistres pour une campagne !!! </p>
	@endif

<br>
<p><a href="{{route('pertes.create')}}">Declarez une perte</a>
/ <a href="{{route('getallAll_losing')}}">Total_Pertes </a>
</p>
@stop
@section('retour')
<p><a href="/ferme">Menu Principal</a></p>
@endsection

@section('footer')
@include('layout.partials.footer')
@stop