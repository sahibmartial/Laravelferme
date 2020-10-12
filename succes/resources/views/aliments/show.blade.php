@extends('layout.app')
@section('title')
<title>ALIMENTS</title>
@stop
@section('contenu')
@include('shared.aliment')

<p><a href="{{ route('aliments.edit', $aliments)}}">Modifier  Achat Aliment</a></p>

<form action="{{route('aliments.destroy',$aliments)}}" method="POST">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
@stop

@section('retour')
<p><a href="{{route('campaliments')}}">retour achats Accessoires</a></p>
@stop