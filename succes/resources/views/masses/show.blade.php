
@extends('layout.app')
@section('title')
<title>MASSE</title>
@stop
@section('contenu')
@include('shared.show_masses')

<p><a href="{{ route('masses.edit', $masses)}}">Modifier Masse</a>
</p>

<form action="{{route('masses.destroy',$masses)}}" method="POST" onsubmit="return confirm('Etes-vous sure ?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
@stop

@section('retour')
<p><a href="{{route('masses.index')}}">retour</a></p>
@stop