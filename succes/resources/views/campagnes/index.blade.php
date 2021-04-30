@extends('base')
@section('title')
<title>CAMPAGNES</title>
@stop
@section('content')

<div class="col-lg-0 mt-2">
<a href="/OutilsCampagne">Retour</a>	
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
		$campagne)}}">{{ $campagne->intitule}}-{{$campagne->obs}}</a></li>	
	@endforeach
    </ul>
	<div>
	{{ $campagnes->links() }}
    </div>
	@else
	<div class="alert alert-success">
	<p>Aucune Campagne en Cours  Enregistrée !!! </p>
	</div>
	@endif
	<hr>
    <p>
	 <a href="{{route('campagnes.create')}}">créer une campagne</a>
	 /  <a href="/formCapital">Ajout-Capital</a>

   </p>


</div>
@stop
