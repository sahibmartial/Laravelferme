@extends('base')
@section('title')
<title>Accessoires</title>
@stop

@section('content')
<div class="text-center mt-4 mb-4">
	<ul>
	@if($accessoires->count()>0)
	@foreach($accessoires as $accessoire)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('accessoires.show',
		$accessoire->id)}}">{{ $accessoire->campagne}}-{{ $accessoire->libelle}}-{{$accessoire->obs}}</a></li>
	@endforeach
	</ul>
	<div class="text-center">
		{{$accessoires->links()}}
	</div>
			
	@else
	<div class="alert alert-success">
	<p>Aucun Accessoires Enregistres pour une campagne !!! </p>
	</div>
	@endif

<br>
<p><a href="{{route('accessoires.create')}}">Enregister un accessoire</a>
	/ <a href="{{route('get_all_accesoires')}}">All_Accesoires for_this_campagne</a>
</p>

<hr>
<p><a href="/achats">Retour Achats</a></p>
	

</div>


@stop



