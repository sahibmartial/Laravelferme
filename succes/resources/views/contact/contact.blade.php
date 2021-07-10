@extends('base')
@section('title')
<title>Contact - Ferme Maya</title>
@stop
@section('content')
@if($notification ?? '')
 <div class="alert alert-info mt-3">{{$notification}}</div>
@endif
<div class="text-center">
<h3>Nous contacter</h3>
<form name="myForm" action="{{route('sendcontact')}}" method="POST">
	{{ csrf_field() }}
	<div class="form-group">
	{{ Form::label('Nom', 'Nom:') }}      
	<input type="text" id="nom" name="nom" placeholder="Entrez votre nom " class="form-control">
	{!! $errors->first('nom','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Email', 'Email:') }}       
	<input type="email" id="eamil" name="email" placeholder="Votre mail" class="form-control">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}
	</div>

   <div class="form-group">
   {{ Form::label('Message', 'Message:') }}
   <textarea name="content" placeholder="vottre message" class="form-control"></textarea>
	{!! $errors->first('content','<span class="error-msg">:message</span>') !!}
   </div>
  
   <button type="submit" onclick="validateForm()" class="btn btn-success">Déclarez perte</button>
	
</form>
</div>
<script>
function validateForm() {

let errors=[];
let nom = document.forms["myForm"]["nom"].value;
let email = document.forms["myForm"]["email"].value;
let msge = document.forms["myForm"]["content"].value;


if(!nom.length >0){
	
	errors.push('Nom manquant.\n');
}
if (!email.length >0) {
	
	errors.push('Email manquant.\n');
}
if (!msge.length >0) {
	
	errors.push('Message manquant.\n');
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