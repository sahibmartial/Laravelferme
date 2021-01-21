@extends('base')
@section('content')
{{--
<h1>Info Achat Poussins Campagne</h1>
<p>{{ $lists->campagne}}</p>
<p>{{ $lists->quantite}}</p>
<p>{{ $lists->priceUnitaire}}</p>
<p>{{ $lists->fournisseur}}</p>
<p>{{ $lists->obs}}</p>
--}}

<div class="text-center mt-4 mb-4">
	<h3>Detail Achat poussins</h3>
	@include('shared.head')
	<hr>
	<p><a href="{{ route('poussins.edit', $lists)}}">Modifier  Achat Poussins</a> / <a href="{{route('pdf_poussins',['data'=>$lists->campagne])}}">download</a></p>
	<form action="{{route('poussins.destroy',$lists)}}" method="POST" 
onsubmit="return confirm('Etes vous sure?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>
<hr>
<p><a href="{{route('head')}}">retour achats poussins</a></p>
	
</div>



@stop
