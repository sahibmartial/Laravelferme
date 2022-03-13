@extends('base')
@section('title')
<title>Aliments</title>
@stop

@section('content')
<div class="text-center mt-4">
    <div class="text-right mb-2">

        <form  name="myForm" action="{{route('searchaliment')}}" onsubmit="return validateForm()" method="post">
            @csrf
		     <p>Rechercher aliment  par campagne </p>

			<input type="text" name="searchcampagne"   id="searchcampagne" placeholder="Search">

		     <input type="submit" value="Recherchez">

        </form>
   </div>

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
<p><a href="{{route('aliments.create')}}">Enregister  Achat Aliment </a>
/  <a href="{{route('getallAliments')}}">All_Aliments_of_one_camapgne </a>
</p>
<p><a href="/achats"> Menu Achats</a></p>
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

