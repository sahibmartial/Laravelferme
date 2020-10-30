@extends('layout.addmorealiments')
@section('contenu')
{{--
<h1>Declarations Pertes</h1>
<p>{{ $lists->campagne}}</p>
<p>{{ $lists->quantite}}</p>
<p>{{ $lists->priceUnitaire}}</p>
<p>{{ $lists->fournisseur}}</p>
<p>{{ $lists->obs}}</p>
--}}
@include('shared.pertes')
<br>
<p><a href="{{ route('pertes.edit', $lists)}}">Modifier Perte</a></p>

<form action="{{route('pertes.destroy',$lists)}}" method="POST">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
@stop
<br>
@section('retour')
<p><a href="{{route('perte')}}">retour Pertes</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop