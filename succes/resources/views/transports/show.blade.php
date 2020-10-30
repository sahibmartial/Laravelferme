<?php
$index=$transports->campagne_id;
?>
@extends('layout.addmorealiments')
@section('title')
<title>TRANSPORT</title>
@stop
@section('contenu')
@include('shared.showtransport')

<p><a href="{{ route('transports.edit', $transports)}}">Modifier  Frais</a>
/
<a href="/listerallfrais?id=<?php echo $index ?>">All Frais for this campagne</a>
</p>

<form action="{{route('transports.destroy',$transports)}}" method="POST">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
@stop

@section('retour')
<p><a href="{{route('transport')}}">retour liste Frais</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop