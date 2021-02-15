@extends('base')
@section('title')
<title>BILAN</title>
@stop
@section('content')
<center>
	@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<h2 class="mt-4 text-center">{{$bilans->count() }} Bilan(s) </h2>
<ul>
	@if($bilans->count()>0)
	@foreach($bilans as $bilan)
	<!--utilisation des routes -->
	<li><a href="{{ route('bilans.show',$bilan)}}">{{$bilan->campagne}}</a></li>
	@endforeach
	</ul>

	@else
	<p>Aucun Bilan Enregistre !!! </p>
	@endif
</center>
	<div class="text-center"><a href="{{route('get_billandetaille')}}">Obtenir-bilan-Detaille</a></div>
	<hr>
	<p class="text-center"><a href="/ferme">Retour Menu Principale</a></p>
	
@stop
