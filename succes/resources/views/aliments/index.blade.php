@extends('layout.addmorealiments')
@section('title')
<title>Aliments</title>
@stop

@section('contenu')
<ul>
	@if($aliments->count()>0)
	@foreach($aliments as $aliment)
	<!--utilisation des routes -->
	<li><a href="{{ 
		route('aliments.show',
		$aliment->id)}}">{{ $aliment->campagne}}-{{ $aliment->libelle}}</a></li>
	@endforeach
	</ul>
	<div>
		{{$aliments->links()}}
	</div>
	@else
	<p>Aucun Achat Aliments Enregistres pour une campagne !!! </p>
	@endif

<br>
<p><a href="{{route('aliments.create')}}">Enregister un Achat Aliment </a>
/  <a href="{{route('getallAliments')}}">All_Aliments_of_one_camapgne </a>
</p>
@stop
@section('retour')
<p><a href="/achats"> Menu Achats</a></p>
@endsection
@section('footer')
@include('layout.partials.footer')
@stop