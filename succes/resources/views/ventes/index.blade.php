<?php
/*use App\Http\Controllers\VenteController;
$vente= new VenteController();
$result=$vente->calculateVenteOfCampagne(1);*/
 //  echo $result;
?>
@extends('base')
@section('title')
<title>Vente</title>
@stop
@section('content')
<div class="text-center mt-4">
	@if ($message = Session::get('success'))
 <div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
@if($ventes->count()>0)
     <ul>

	    @foreach($ventes as $vente)
	      <!--utilisation des routes -->
	   <li><a href="{{ 
		   route('ventes.show',
		    $vente->id)}}">{{ $vente->campagne}}-{{ $vente->date}}</a></li>
		
     	@endforeach
	</ul>
	<div>
		{{$ventes->links()}}
	</div>
@else
	<div class="alert alert-success">
	<p>Aucune Vente  Enregistree pour une campagne En cours !!! </p>
	</div>
@endif
<br>
<p class="text-center"><a href="{{route('ventes.create')}}">Enregister une Vente</a>
	 |
	<a href="{{route('recap_vente')}}">Recap Vente</a>

</p>
<p><a href="/OutilsCampagne">Menu Campagne</a></p>
</div>
@stop



