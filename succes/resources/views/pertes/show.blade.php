@extends('base')
@section('content')
{{--
<h1>Declarations Pertes</h1>
<p>{{ $lists->campagne}}</p>
<p>{{ $lists->quantite}}</p>
<p>{{ $lists->priceUnitaire}}</p>
<p>{{ $lists->fournisseur}}</p>
<p>{{ $lists->obs}}</p>
--}}

<h2 class="text-center mt-3">Detail perte</h2>
@include('shared.pertes')
<br>
<p class="text-center"><a href="{{ route('pertes.edit', $lists)}}">Modifier Perte</a></p>

<form  class="text-center" action="{{route('pertes.destroy',$lists)}}" method="POST"
onsubmit="return confirm('Etes vous sure?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input  type="submit" value="supprimer">
	
</form>

<p class="text-center"><a href="{{route('perte')}}">retour Liste Pertes</a></p>
@stop
<br>


