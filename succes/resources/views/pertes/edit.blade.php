@extends('base')
@section('content')
<div class="text-center mt-4">
<h3>Modification Perte #{{ $pertes->id}}</h3>
<form  name="myForm" action="{{route('pertes.update',$pertes)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<div class="form-group">
     {{ Form::label('Date', 'Date:') }}
                            <br>
        <input type="date" name="date_die" placeholder=""
             @error('date_die') is-invalid @enderror" name="date_die"
              value="{{old('date_die') ?? $pertes->date_die}}" required class="form-control">
                 @error('date_die')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
             @enderror
                            
  </div>

  <div class="form-group">
  {{ Form::label('ID', 'ID:') }}
  <input type="text" name="campagne_id" placeholder="ID"
   value="{{old('campagne_id')?? $pertes->campagne_id}}"  class="form-control">
   {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
  
  </div>
  <div class="form-group">
  {{ Form::label('Campagne', 'Campagne:') }}
  <input type="text" name="campagne" placeholder="Nom"
   value="{{old('campagne')?? $pertes->campagne}}"  class="form-control">
   {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  </div>
	
	<div class="form-group">
  {{ Form::label('Quantite', 'Quantite:') }}
  <input type="number" name="quantite"  placeholder="quantite" 
  value="{{old('quantite')?? $pertes->quantite}}" class="form-control">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
  </div>

  <div class="form-group">
  {{  Form::label('Suggestions', 'Suggestions: ')  }}
  <textarea name="suggest" placeholder="Les recommandations ici" class="form-control" >{{old('suggest')?? $pertes->suggestion}}</textarea> 
	{!! $errors->first('suggest','<span class="error-msg">:message</span>') !!}
  </div>

	<!--<input type="submit" value="Editer Perte">-->
  <button type="submit" onclick="validateForm()" class="btn btn-success">Modifier perte</button>
</form>
<br>
<p><a href="{{route('perte')}}">Accueil</a></p>
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
