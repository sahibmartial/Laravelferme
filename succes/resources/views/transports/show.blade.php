<?php
$index=$transports->campagne_id;
?>
@extends('base')
@section('title')
<title>TRANSPORT</title>
@stop
@section('content')
<h3 class="text-center mt-3">Frais-de-la-Campagne</h3>
<div class="text-center mb-3">
	@include('shared.showtransport')

</div>

<p class="text-center"><a href="{{ route('transports.edit', $transports)}}">Modifier  Frais</a>
/
<a href="/listerallfrais?id=<?php echo $index ?>">Frais-de-La-Campagne</a>
</p>

<form class="text-center" action="{{route('transports.destroy',$transports)}}" method="POST" onsubmit="return confirm('Etes vous sure?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<hr>
<p class="text-center"><a href="{{route('transport')}}">retour liste Frais</a></p>
@stop

