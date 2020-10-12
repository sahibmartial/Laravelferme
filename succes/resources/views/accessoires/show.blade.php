@extends('layout.app')
@section('title')
<title>Accessoires</title>
@stop
@section('contenu')
@include('shared.accessoires')
{{--<h1>Info Achat Accesoires Campagne</h1>--}}
{{--<p>{{ $accessoires->campagne}}</p>--}}
{{--<p>{{ $accessoires->libelle}}</p>--}}
{{--<p>{{ $accessoires->quantite}}</p>--}}
{{--<p>{{ $accessoires->priceUnitaire}}</p>--}}
{{--<p>{{ $accessoires->obs}}</p>--}}
<p><a href="{{ route('accessoires.edit', $accessoires)}}">Modifier  Achat Accessoire</a></p>

<form action="{{route('accessoires.destroy',$accessoires)}}" method="POST">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<p><a href="{{route('caccessoires')}}">retour achats Accessoires</a></p>
@stop