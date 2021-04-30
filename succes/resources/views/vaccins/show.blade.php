@extends('base')
@section('title')
<title>VACCIN</title>
@stop
@section('content')

<h2 class="text-center mt-2">Detail Vaccin</h2>
@if ($message = Session::get('success'))
 <div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="text-center mt-4">
@include('shared.showvaccin')
<hr>
<p><a href="{{ route('vaccins.edit', $suivi)}}">Modifier Vaccin</a></p>

<form action="{{route('vaccins.destroy',$suivi)}}" method="POST"onsubmit="return confirm('Etes vous sure?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<hr>
<p><a href="{{route('vaccin')}}">Retour suivi</a></p>
</div>
@stop
