<?php
/*use App\Http\Controllers\TransportController;
$vente= new TransportController();
$result=$vente->calculateFraisTotalOfCampagne(1);*/
?>
@extends('base')
@section('title')
<title>TRANSPORT</title>
@stop
@section('content')
<div class="text-center mt-4">
	@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<ul>
	@if($transports->count()>0)
	@foreach($transports as $transport)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('transports.show',
		$transport->id)}}">{{ $transport->campagne}}-{{ $transport->obs}}</a></li>
	@endforeach
	</ul>
	<div>
		{{$transports->links()}}
	</div>
	@else
	<p>Aucun  frais de transport  Enregistres pour une campagne !!! </p>
	@endif

<br>
<div><a href="{{route('transports.create')}}">Enregister un frais de transport</a>
/ <a href="{{route('get_all_transports')}}">AllFrais_For_this campagne</a>

</div>

<hr>
<p><a href="/achats"> Retour Achats</a></p>
</div>
@stop
