@extends('base')
@section('title')
<title>Employer</title>
@stop
@section('content')
<h2>{{$employes->count() }} Employer(s) </h2>
<div class="text-center mt-4">
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
<hr>
<a href="/ferme">Retour Menu Principale</a>
</div>
@stop
