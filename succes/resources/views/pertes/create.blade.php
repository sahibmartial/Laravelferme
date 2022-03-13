<?php
//use App\Campagne;
use App\Http\Controllers\CampagneController;
//echo "string";
  //$var= $id->toJson();
$duredevie=0;

  ?>
@extends('base')
@section('title')
<title>PERTES</title>
@endsection
@section('content')
<div class="text-center">
<h2>Declarer une Perte</h2>
<form  name="myForm" action="{{route('pertes.store')}}"  method="POST">
	{{ csrf_field() }}
  <div class="form-group">
      {{ Form::label('Date', 'Date:') }}
     <input type="date" name="date_die" placeholder="" class="form-control"
      @error('date_die') is-invalid @enderror"
       name="date_die" value="{{ old('date_die') }}" required autocomplete="date_die" autofocus >
        @error('date_die')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
          </span>
        @enderror
   </div>
	{{--<input type="text" name="campagne_id" placeholder="Entrez ID " value={{ old('campagne_id') }}>
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}

    <div class="form-group">
    <!-- {{ Form::label('Campagne', 'Campagne:') }}
    <input type="text" name="campagne" placeholder="Entrez nom campagne "
    value="{{ old('campagne') }}" class="form-control">
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
    -->
     <select class="form-select mb-2" aria-label="Default select example" name="campagne" id="campagne">
        <option selected>CampagneX</option>
           @foreach ($campagnes as $campagne)
               <option value="{{ $campagne->intitule }}">{{ $campagne->intitule }}</option>
           @endforeach

   </select>

    </div>
    <div class="form-group">
    {{ Form::label('Quantite', 'Quantite:') }}
    <input type="number" name="quantite"
    placeholder="Entrez la quantite de pertes " value="{{old('quantite')}}"  class="form-control" >
   	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
    </div>

  <div class="form-group">
  {{  Form::label('Observations', 'Observations: ')  }}
	<textarea name="cause" placeholder="Causes de la mort" class="form-control"></textarea>
	{!! $errors->first('cause','<span class="error-msg">:message</span>') !!}
  </div>
  <div class="form-group">
  {{  Form::label('Suggestions', 'Suggestions: ')  }}
  <textarea name="suggest" placeholder="Les recommandations ici" class="form-control" disabled></textarea>
	{!! $errors->first('suggest','<span class="error-msg">:message</span>') !!}
  </div>
	<!--<input type="submit" value="Déclarez perte" class="btn btn-success">-->
  <button type="submit" onclick="validateForm()" class="btn btn-success">Déclarez perte</button>
</form>
<br>
<p><a href="{{route('pertes.index')}}">Liste pertes</a></p>

<hr>
<p><a href="/perte"> Retour menu principal </a></p>

</div>

<script>
function validateForm() {

let errors=[];
let date_die = document.forms["myForm"]["date_die"].value;
let nom = document.forms["myForm"]["campagne"].value;
let qte = document.forms["myForm"]["quantite"].value;



if(!date_die.length >0){

	errors.push('Date manquante.\n');
}
if (!nom.length >0) {

	errors.push('Campagne manquante.\n');
}
if (!qte.length >0) {

	errors.push('Quantite manquant.\n');
}


if (errors.length>0) {
	event.preventDefault();
	alert(errors)
}
//console.log("hello")
 /* let x = document.forms["myForm"]["fname"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }*/
}
</script>
@stop

