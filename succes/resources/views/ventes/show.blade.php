@extends('base')
@section('title')
<title>VENTE</title>
@stop
@section('content')

<h2 class="text-center mt-2">Detail Vente</h2>
@if ($message = Session::get('success'))
 <div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="text-center mt-4">
@include('shared.showvente')
<hr>
<p><a href="{{ route('ventes.edit', $ventes)}}">Modifier Vente</a></p>

<form action="{{route('ventes.destroy',$ventes)}}" method="POST"onsubmit="return confirm('Etes vous sure?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<hr>
<p><a href="{{route('vente')}}">Retour Vente</a></p>
</div>
@stop
