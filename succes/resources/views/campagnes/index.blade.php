@extends('base')
@section('title')
<title>CAMPAGNES</title>
@stop
@section('content')

<div class="col-lg-0 mt-2">
<a href="/ferme">Retour Menu Principale</a>	
</div>
<div class="text-center">

	<h2>{{$campagnes->count() }} Campagne(s) </h2>
	@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<ul>

	@if($campagnes->count()>0)
	@foreach($campagnes as $campagne)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('campagnes.show',
		$campagne)}}">{{ $campagne->intitule}}</a></li>	
	@endforeach
    </ul>
	<div>
	{{ $campagnes->links() }}
    </div>
	@else
	<p>Aucune Campagne Enregistree !!! </p>
	@endif
<p><a href="{{route('campagnes.create')}}">creer une campagne</a>
</p>

</div>

@stop
