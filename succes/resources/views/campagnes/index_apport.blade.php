@extends('base')
@section('title')
<title>Apport-Campagne</title>
@stop
@section('content')

<div class="col-lg-0 mt-2">
<a href="/ferme">Retour Menu Principale</a>	
</div>
<div class="text-center">

	<h2>{{$apports->count() }} Apport(s) </h2>
	@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<ul>

	@if($apports->count()>0)
	@foreach($apports as $campagne)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('apports.show',
		$campagne)}}">{{ $campagne->campagne}}-{{$campagne->apport}}-{{$campagne->origine_apport}}-{{$campagne->obs}}</a></li>	
	@endforeach
    </ul>
	<div>
	{{ $apports->links() }}
    </div>
	@else
	<p>Aucune Campagne en Cours  Enregistrée !!! </p>
	@endif
<p>
	  <a href="/formCapital">Ajout-Capital</a>

</p>
</div>

@stop