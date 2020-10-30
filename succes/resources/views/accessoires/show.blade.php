<?php
$index=$accessoires->campagne_id;
?>
@extends('layout.addmorealiments')
@section('title')
<title>Accessoires</title>
@stop
@section('contenu')
@include('shared.accessoires')
{{--<h1>Info Achat Accesoires Campagne</h1>--}}
{{--<p>{{ $accessoires->campagne}}</p>--}}
{{--<p>{{ $accessoires->libelle}}</p>--}}
{{--<p>{{ $accessoires->quantite}}</p>--}}
{{--<p>{{ $accessoires->priceUnitaire}}</p>--}}
{{--<p>{{ $accessoires->obs}}</p>--}}
<p><a href="{{ route('accessoires.edit', $accessoires)}}">Modifier  Achat Accessoire</a>
/
<a href="/listingaccessoireonecampagne?id=<?php echo $index ?>">All Accssoires for this campagne</a>	
</p>
<br>
<form action="{{route('accessoires.destroy',$accessoires)}}" method="POST"
onsubmit="return confirm('Etes-vous sure ?');">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	<input type="submit" value="supprimer">
	
</form>

@stop
@section('retour')
<p><a href="{{route('caccessoires')}}">retour achats Accessoires</a></p>
{{--<p><a href="/achats">Retour Achats</a></p>--}}
@endsection
@section('footer')
@include('layout.partials.footer')
@stop