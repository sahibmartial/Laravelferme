@extends('layout.addmorealiments')
@section('contenu')
{{--
<h1>Info Achat Poussins Campagne</h1>
<p>{{ $lists->campagne}}</p>
<p>{{ $lists->quantite}}</p>
<p>{{ $lists->priceUnitaire}}</p>
<p>{{ $lists->fournisseur}}</p>
<p>{{ $lists->obs}}</p>
--}}
@include('shared.head')
<br>
<p><a href="{{ route('poussins.edit', $lists)}}">Modifier  Achat Poussins</a></p>

<form action="{{route('poussins.destroy',$lists)}}" method="POST" 
onsubmit="return confirm('Etes vous sure?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<br>
@stop
@section('retour')
<p><a href="{{route('head')}}">retour achats poussins</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop