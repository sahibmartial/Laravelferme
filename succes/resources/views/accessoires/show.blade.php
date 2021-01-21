<?php
$index=$accessoires->campagne_id;
?>
@extends('base')
@section('title')
<title>Accessoires</title>
@stop
@section('content')
<div class="text-center mt-4 mb-4">
	<h3>Detail Accesssoire</h3>
	@include('shared.accessoires')
	<p class="mt-4"><a href="{{ route('accessoires.edit', $accessoires)}}">Modifier  Achat Accessoire</a>
/
<a href="/listingaccessoireonecampagne?id=<?php echo $index ?>">All Accssoires for this campagne</a>	
</p>
<form action="{{route('accessoires.destroy',$accessoires)}}" method="POST"
onsubmit="return confirm('Etes-vous sure ?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">	
</form>
<hr>
<p><a href="{{route('caccessoires')}}">retour achats Accessoires</a></p>
{{--<p><a href="/achats">Retour Achats</a></p>--}}

</div>

{{--<h1>Info Achat Accesoires Campagne</h1>--}}
{{--<p>{{ $accessoires->campagne}}</p>--}}
{{--<p>{{ $accessoires->libelle}}</p>--}}
{{--<p>{{ $accessoires->quantite}}</p>--}}
{{--<p>{{ $accessoires->priceUnitaire}}</p>--}}
{{--<p>{{ $accessoires->obs}}</p>--}}


@stop

