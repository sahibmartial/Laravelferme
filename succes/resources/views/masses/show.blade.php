
@extends('base')
@section('title')
<title>MASSE</title>
@stop
@section('content')
<p class="text-center mt-2 mb-2">Detail masse </p>
<div class="text-center mt-4">
@include('shared.show_masses')

<p><a href="{{ route('masses.edit', $masses)}}">Modifier Masse</a>
</p>

<form action="{{route('masses.destroy',$masses)}}" method="POST" onsubmit="return confirm('Etes-vous sure ?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<hr>
<p><a href="{{route('masses.index')}}">retour</a></p>
</div>
@stop
