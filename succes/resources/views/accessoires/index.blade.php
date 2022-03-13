@extends('base')
@section('title')
<title>Accessoires</title>
@stop

@section('content')

<div class="text-center mt-4 mb-4">

	 <div class="text-right">

        <form  name="myForm" action="{{route('searchaccessoires')}}" onsubmit="return validateForm()" method="post">
            @csrf
		     <p>Rechercher accessoires par campagne </p>

			<input type="text" name="searchcampagne"   id="searchcampagne" placeholder="Search">

		     <input type="submit" value="Recherchez">

        </form>
   </div>

	<ul>
	@if($accessoires->count()>0)
	@foreach($accessoires as $accessoire)
	<!--utilisation des routes -->
	<li><a href="{{
		route('accessoires.show',
		$accessoire->id)}}">{{ $accessoire->campagne}}-{{ $accessoire->libelle}}-{{$accessoire->obs}}</a></li>
	@endforeach
	</ul>
	<div class="text-center">
		{{$accessoires->links()}}
	</div>

	@else
	<div class="alert alert-success">
	<p>Aucun Accessoires Enregistres pour une campagne !!! </p>
	</div>

	@endif

<br>
<p><a href="{{route('accessoires.create')}}">Enregister un accessoire</a>
	/ <a href="{{route('get_all_accesoires')}}">Listing tous les accesoires de la campagne</a>
</p>

<hr>
<p><a href="/achats">Retour Achats</a></p>

</div>


@stop

<script>
	function validateForm()
	{
        let x = document.forms["myForm"]["searchcampagne"].value;
        if (x=="" ) {
           alert("Champ ne peut être vide, merci de selectionner une campagne.");
           return false;
        } else {

          console.log(x)
        }
    }
 </script>
