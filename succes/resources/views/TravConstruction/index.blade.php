@extends('base')
@section('title')
<title>TravaucCostruction</title>
@stop

@section('content')
<div class="col-lg-0 mt-2">
<a href="/ferme">Menu Principale</a>
</div>
<div class="text-center">
	
	@if ($message = Session::get('success'))
   <div class="alert alert-success">
    <p>{{ $message }}</p>
   </div>
    @endif
	@php
	//dd($travaux)
	@endphp
	@if(count($travaux)>0)  
	<h2>{{ count($travaux) }} Materiel(s) </h2>
	<ul>
	   
		    @foreach($travaux as  $materiel)
			<li><a href="{{route('travaux.show',$materiel)}}">{{ $materiel['materiel']}} --{{ $materiel['date']}} --{{ $materiel['obs']}} </a></li>
		    @endforeach
          
		
	</ul>
	    <div>
      	{{ $travaux->links() }}
       </div>
	      
       @else
  	      <div class="alert alert-success">
	        <p>Aucun Achat de materiels detectés !!! </p>
	      </div>

	@endif  

    <div>
     <p><a href="{{route('travaux.create')}}">Declarez un Materiel</a></p>
    </div>	  
	
</div>

@stop

