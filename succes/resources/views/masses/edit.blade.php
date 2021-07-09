@extends('base')
@section('content')
<div class="text-center mt-4">
<h1>Modification Masse #{{ $masses->id}}</h1>
<form name="myForm" action="{{route('masses.update',$masses)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<div class="form-group">
	{{ Form::label('Campagne', 'Campagne:') }}
	<input type="text" name="campagne" placeholder="Entrez votre titre" 
	value="{{ old('campagne')?? $masses->campagne}}" class="form-control">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Masse', 'Masse:') }}
	<input type="text" name="mean_masse" cols="20" rows="10"
	 placeholder="quantite" value=" {{old('mean_masse')?? $masses->mean_masse}}" class="form-control">
	{!! $errors->first('mean_masse','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{  Form::label('Observations', 'Observations: ')  }}
	<textarea name="obs" placeholder="RAS" 
	value=" {{old('obs')?? $masses->obs}}" class="form-control"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	</div>
	<!--<input type="submit" value="Modifier Masse" class="btn btn-success">-->
	<button type="submit" onclick="validateForm()" class="btn btn-success">Enregister masse</button>
</form>
<hr>
<p><a href="{{route('masses.index')}}">Accueil</a></p>
</div>

<script>
function validateForm() {

let errors=[];

let nom = document.forms["myForm"]["campagne"].value;
let masse = document.forms["myForm"]["mean_masse"].value;


if (!nom.length >0) {
	
	errors.push('Campagne manquante.\n');
}
if (!masse.length >0) {
	
	errors.push('Masse manquante.\n');
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
