@extends('base')
@section('title')
<title>CAMPAGNE</title>
@stop
@section('content')

<div class="text-center mt-5">
	@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
	<div class="text-center mb-3">
		@include('shared.apport_show')
	</div>
	

	<p><a href="{{ route('apports.edit', $apports)}}">Modifier Apport</a>
	
</p>
</div>
 


{{--<form action="{{route('campagnes.destroy',$campagnes)}}" method="POST"
 onsubmit="return confirm('Etes-vous sure?');" 
 >
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>--}}
<p class="btn btn-info float-right"><a href="{{route('apports.index')}}">Retour liste Apport</a></p>
@stop
