@extends('base')
@section('title')
<title>PERTES</title>
@endsection
@section('content')
		@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<ul>
	@if($pertes->count()>0)
	@foreach($pertes as $campagne)
	<!--utilisation des routes -->
	<li ><a href="{{ 
		route('pertes.show',
		$campagne->id)}}">{{ $campagne->campagne}}-{{$campagne->cause}}</a></li>
	@endforeach
	</ul>
	<div class="text-center">
		{{$pertes->links()}}
	</div>
	@else
	<p class="text-center">Aucune quantite de pertes Enregistres pour une campagne !!! </p>
	@endif

<br>
<p class="text-center"><a href="{{route('pertes.create')}}">Declarez une perte</a>
/ <a href="{{route('getallAll_losing')}}">Total_Pertes </a>
</p>
<hr>
<p class="text-center"><a href="/ferme">Menu Principal</a></p>

@stop


