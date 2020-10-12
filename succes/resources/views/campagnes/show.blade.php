@extends('shared.ferme')
@section('contenu')
<h1>Info Campagne</h1>
<p>{{ $campagnes->intitule}}</p>
<p>{{ $campagnes->status}}</p>
<p><a href="{{ route('campagnes.edit', $campagnes)}}">Modifier Campagne</a></p>

<form action="{{route('campagnes.destroy',$campagnes)}}" method="POST">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<p><a href="{{route('home')}}">Accueil</a></p>
@stop