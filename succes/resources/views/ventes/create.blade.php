<?php 
//use App\Campagne;
use App\Http\Controllers\CampagneController;
//echo "string";
  //$var= $id->toJson();
$duredevie=0;
  ?>

@extends('base')
@section('title')
<title>VENTES</title>
@endsection
@section('content')
<div class="text-center mt-4">
<h2>Declarer une Vente</h2>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<form name="myForm" action="{{route('ventes.store')}}" onsubmit="validateForm()" method="POST">
	{{ csrf_field() }}
	{{--<input type="text" name="campagne_id" placeholder="Entrez ID "
	 value="{{ old('campagne_id') }}??" class="form-control">
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}

	<div class="form-group">
	{{  Form::label('Date', 'Date: ')  }}
    <input type="date" name="date" placeholder="" value="{{ old('date') }}" class="form-control">
	 {!! $errors->first('date','<span class="error-msg">:message</span>') !!}
	 </div>
    <div class="form-group">
	{{  Form::label('Camp', 'Campagne: ')  }}
	<input type="text" name="campagne" placeholder="Entrez nom campagne " 
	value="{{ old('campagne') }}" class="form-control">
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
	</div>
	
    <div class="form-group">
	{{  Form::label('Qte', 'Quantite: ')  }}
	<input type="number" name="quantite" placeholder="Entrez la quantite vendue "
	 value="{{ old('quantite') }}" class="form-control">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}

	</div>

    <div class="form-group">
	{{  Form::label('PU', 'Prix U: ')  }}
    <input type="number" name="priceUnitaire" placeholder="Prix Unitaire " 
	value="{{ old('priceUnitaire') }}"class="form-control">
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
	</div>
    
	<div class="form-group">
	 {{  Form::label('acheteur', 'Acheteur: ')  }}
     {{ Form::select('acheteur', array('Particulier' => 'Particulier', 'Grossiste' => 'Grossiste','Restaurant'=>'Restaurant'), 'Particulier')}}
     {{--<input type="text" name="acheteur" placeholder="Acheteur">--}}
	{!! $errors->first('acheteur','<span class="error-msg">:message</span>') !!}
	</div>
 
	 <div class="form-group">
	 {{  Form::label('contact', 'Contact: ')  }}
	 <input type="text" name="contact" placeholder="01-02-03-04-05" class="form-control">
     {!! $errors->first('contact','<span class="error-msg">:message</span>') !!}
	 </div>

    <div class="form-group">
	{{  Form::label('events', 'Events: ')  }}
	{{ Form::select('events', array('Party' => 'Party', 'Birdthay' => 'Birdthay','Death'=>'Death','Autres'=>'Autres','Commerce'=>'Commerce'),'Autres') }}
	{{--<input type="text" name="events" placeholder="EVENTS">--}}
	{!! $errors->first('events','<span class="error-msg">:message</span>') !!}

	</div>
	
	<div class="form-group">
	{{  Form::label('avance', 'Avance: ')  }}
	<input type="number" name="avance" step="any" placeholder="Avance" value="" class="form-control">
	{!! $errors->first('avance','<span class="error-msg">:message</span>') !!}
	</div>
	 
	 <div class="form-group">
	 {{  Form::label('impaye', 'Impaye: ')  }}
	<input type="number" name="impaye" step="any" placeholder="Impaye" value="" class="form-control">
	{!! $errors->first('impaye','<span class="error-msg">:message</span>') !!}
	 </div>
	<!--
   <div class="form-group">
    {{  Form::label('regler', 'Regler: ')  }}
	{{ Form::select('regler', array('OK' => 'OK', 'NOK' => 'NOK')) }}
   </div>
    -->
   <div class="form-group">
   {{  Form::label('obs', 'Obs: ')  }}
   <textarea name="obs" placeholder="Observations" class="form-control" ></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
   
   </div>
	<input type="submit" value="Enregister vente"  class="btn btn-success">
</form>
<br>
<p><a href="{{route('ventes.index')}}">Liste ventes</a></p>

<hr>
<p><a href="/vente"> Retour menu principal </a></p>
</div>

<script>
function validateForm() {
	let errors=[];
let datecreate = document.forms["myForm"]["date"].value;
let campagne = document.forms["myForm"]["campagne"].value;
let qte = document.forms["myForm"]["quantite"].value;
let pu = document.forms["myForm"]["priceUnitaire"].value;
let avance = document.forms["myForm"]["avance"].value;
let impaye = document.forms["myForm"]["impaye"].value;

if (!datecreate.length >0) {
    errors.push('Date  manquante.\n');

    }
if(!campagne.length >0){
	
	errors.push('Campagne manquante.\n');
}
if (!qte.length >0) {
	
	errors.push('Quantite manquante.\n');
}
if (!pu.length >0) {
	
	errors.push('Prix Unitaire manquant.\n');
}


if (errors.length>0) {
	event.preventDefault();
	alert(errors)
}
//console.log(errors)	
 /* let x = document.forms["myForm"]["fname"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }*/
}
</script>
@stop


