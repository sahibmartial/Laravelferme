<?php
/*use App\Http\Controllers\TransportController;
$vente= new TransportController();
$result=$vente->calculateFraisTotalOfCampagne(1);*/
?>
@extends('base')
@section('title')
<title>TRANSPORT</title>
@stop
@section('content')
<div class="text-center mt-4">

	@if ($message = Session::get('success'))
       <div class="alert alert-success">
          <p>{{ $message }}</p>
      </div>
    @endif

	<div class="text-right mb-2">
	 
        <form  name="myForm" action="{{route('searchtransport')}}" onsubmit="return validateForm()" method="post">
            @csrf
		     <p>Rechercher transport  par campagne </p>
			 
			<input type="text" name="searchcampagne"   id="searchcampagne" placeholder="Search">
              
		     <input type="submit" value="Recherchez">

        </form>
   </div>
	
    <ul>
	    @if($transports->count()>0)
	        @foreach($transports as $transport)
	            <!--utilisation des routes -->
	            <li><a href="{{ 
		       route('transports.show',
		      $transport->id)}}">{{ $transport->campagne}}-{{ $transport->obs}}</a></li>
	        @endforeach
	</ul>
	<div>
		{{$transports->links()}}
	</div>
	    @else
	      <div class="alert alert-success">
        	<p>Aucun  frais de transport  Enregistres pour une campagne !!! </p>
	       </div>
	   @endif

<br>
<div><a href="{{route('transports.create')}}">Enregister un frais de transport</a>
/ <a href="{{route('get_all_transports')}}">AllFrais_For_this campagne</a>

</div>

<hr>
<p><a href="/achats"> Retour Achats</a></p>
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
