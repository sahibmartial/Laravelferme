@extends('base')
@section('title')
<title>Travaux</title>
@stop

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="text-center mt-4">
<h2> Info  Achat matériel</h2>
@include('shared.showtravaux')
<hr>
<p>
<a href="{{route('travauxconstruction.edit',$materiel)}}">Modifiez Materiel</a></p>
/
<form action="{{route('travauxconstruction.destroy',$materiel)}}" method="POST"
 onsubmit="return confirm('Etes-vous sure?');" 
 >
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<hr>
<p><a href="{{route('travauxconstruction.index')}}">Liste materiel</a></p>
</div>
@stop

