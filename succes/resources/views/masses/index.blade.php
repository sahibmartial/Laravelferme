@extends('base')
@section('title')
<title>Masse</title>
@stop

@section('content')
<div class="text-center mt-4">
	@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
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
<hr>
<p><a href="/ferme"> Menu principal</a></p>
</div>
@stop
