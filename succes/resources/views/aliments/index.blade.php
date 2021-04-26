@extends('base')
@section('title')
<title>Aliments</title>
@stop

@section('content')
<div class="text-center mt-4">
	
	<ul>
	@if($aliments->count()>0)
	@foreach($aliments as $aliment)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('aliments.show',
		$aliment->id)}}">{{ $aliment->campagne}}-{{ $aliment->libelle}}-{{$aliment->obs}}</a></li>
	@endforeach
	</ul>
	<div>
		{{$aliments->links()}}
	</div>
	@else
	<div class="alert alert-success">
	<p>Aucun Achat Aliments Enregistres pour une campagne !!! </p>
	</div>
	@endif

<br>
<p><a href="{{route('aliments.create')}}">Enregister un Achat Aliment </a>
/  <a href="{{route('getallAliments')}}">All_Aliments_of_one_camapgne </a>
</p>
<p><a href="/achats"> Menu Achats</a></p>
</div>

@stop

