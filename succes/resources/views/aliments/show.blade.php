<?php
$index=$aliments->campagne_id;
?>
@extends('layout.app')
@section('title')
<title>ALIMENTS</title>
@stop
@section('contenu')
@include('shared.aliment')

<p><a href="{{ route('aliments.edit', $aliments)}}">Modifier  Achat Aliment</a>
	/
<a href="/listerallaliments?id=<?php echo $index ?>">All_foods_for_this_campagne</a>

</p>

<form action="{{route('aliments.destroy',$aliments)}}" method="POST"
onsubmit="return confirm('Etes-vous sure?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
@stop

@section('retour')
<p><a href="{{route('campaliments')}}">retour achats Accessoires</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop