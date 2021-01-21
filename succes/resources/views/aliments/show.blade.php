<?php
$index=$aliments->campagne_id;
?>
@extends('base')
@section('title')
<title>ALIMENTS</title>
@stop
@section('content')
<div class="text-center mt-4">
	<h3>Detail Aliment</h3>
	@include('shared.aliment')

<p class="mt-2"><a href="{{ route('aliments.edit', $aliments)}}">Modifier  Achat Aliment</a>
	/
<a href="/listerallaliments?id=<?php echo $index ?>">All_foods_for_this_campagne</a>

</p>

<form action="{{route('aliments.destroy',$aliments)}}" method="POST"
onsubmit="return confirm('Etes-vous sure?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<p class="mt-2"><a href="{{route('campaliments')}}">retour achats Accessoires</a></p>

</div>

@stop
