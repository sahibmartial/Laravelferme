@extends('layout.addmorealiments')
@section('title')
<title>VENTE</title>
@stop
@section('contenu')
@include('shared.showvente')
<br>
<p><a href="{{ route('ventes.edit', $ventes)}}">Modifier Vente</a></p>

<form action="{{route('ventes.destroy',$ventes)}}" method="POST"onsubmit="return confirm('Etes vous sure?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
@stop
<br>
@section('retour')
<p><a href="{{route('vente')}}">Retour Vente</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop