@extends('shared.ferme')
@section('contenu')
<h1>Info Achat Poussins Campagne</h1>
<p>{{ $lists->campagne}}</p>
<p>{{ $lists->quantite}}</p>
<p>{{ $lists->priceUnitaire}}</p>
<p>{{ $lists->fournisseur}}</p>
<p>{{ $lists->obs}}</p>
<p><a href="{{ route('poussins.edit', $lists)}}">Modifier  Achat Poussins</a></p>

<form action="{{route('poussins.destroy',$lists)}}" method="POST">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<p><a href="{{route('head')}}">retour achats poussins</a></p>
@stop