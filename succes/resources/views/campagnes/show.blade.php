<?php
$index=$campagnes->id;
?>
@extends('layout.addmorealiments')
@section('title')
<title>CAMPAGNE</title>
@stop
@section('contenu')
{{--
<h2>Info Campagne</h2>
<p>{{ $campagnes->intitule}}</p>
<p>{{ $campagnes->status}}</p>
--}}

@include('shared.campagne')
<br>
<p><a href="{{ route('campagnes.edit', $campagnes)}}">Modifier Campagne</a>
	/	
<a href="/cloturer?id=<?php echo $index ?>">Cloturer Campagne</a>
</p>

{{--<form action="{{route('campagnes.destroy',$campagnes)}}" method="POST"
 onsubmit="return confirm('Etes-vous sure?');" 
 >
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>--}}
<p><a href="{{route('home')}}">Accueil</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop