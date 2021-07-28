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
		$masse->id)}}">{{ $masse->campagne}}--{{$masse->date}}--{{$masse->obs}}</a></li>
	@endforeach
</ul>
<div> 
	{{$masses->links()}}
</div>

	@else
	<div class="alert alert-success">
	<p>Aucun Enregistrement de masses disponible !!! </p>
	</div>
	@endif
<p><a href="{{route('masses.create')}}">Enregister une masse </a></p>
<hr>
<p><a href="/ferme"> Menu principal</a></p>
</div>
@stop
