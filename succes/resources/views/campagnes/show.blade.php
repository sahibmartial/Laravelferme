<?php
$index=$campagnes->id;
?>
@extends('base')
@section('title')
<title>CAMPAGNE</title>
@stop
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
{{--
<h2>Info Campagne</h2>
<p>{{ $campagnes->intitule}}</p>
<p>{{ $campagnes->status}}</p>
--}}
<div class="text-center mt-5">
	<div class="text-center mb-3">
		@include('shared.campagne')
	</div>
	

	<p><a href="{{ route('campagnes.edit', $campagnes)}}">Modifier Campagne</a>
	/	
<a href="/cloturer?id=<?php echo $index ?>">Cloturer Campagne</a>
</p>
</div>
 


{{--<form action="{{route('campagnes.destroy',$campagnes)}}" method="POST"
 onsubmit="return confirm('Etes-vous sure?');" 
 >
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>--}}
<p class="btn btn-info float-right"><a href="{{route('campagnes.index')}}">Accueil</a></p>
@stop
