@extends('base')
@section('title')
<title>ACHATS-POUSSINS</title>
@endsection
@section('content')
<p class="flaot-left mt-4 mb_4"><a href="/achats"> Retour Menu Achats </a></p>
<div class="text-center mt-4">
		@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
	<ul>
	@if(count($poussins)>0)

	@foreach($poussins as $key => $campagne)
	<!--utilisation des routes -->
	<li><a href="{{route('poussins.show',$campagne->id)}}">{{ $campagne->campagne}}</a></li>
	@endforeach
	</ul>
	<div>
	{{$poussins->links()}}
    </div>
	@else
	<div class="alert alert-success">
	<p>Aucune quantite de poussins Enregistres pour une campagne !!! </p>
	</div>
	@endif

	<p><a href="{{route('poussins.create')}}">Enregister une quantite de poussins</a></p>
</div>



@stop



