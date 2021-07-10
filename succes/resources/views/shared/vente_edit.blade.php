
<h2>Editer Vente #{{ $ventes->id}}</h2>
<form name="myForm" action="{{route('ventes.update',$ventes)}}" onsubmit="validateForm()" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	
	{{ method_field('PUT')}}
	<div class="form-group">
    {{ Form::label('ID', 'ID: ')  }}
	<input type="text" name="campagne_id" placeholder="Entrez ID" 
	value="{{old('campagne_id')?? $ventes->campagne_id}}" class="form-control">
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Date', 'Date: ')  }}
	<input type="date" name="date_vente" placeholder="Date de vente" 
	value="{{old('campagne_id')?? $ventes->date}}" class="form-control">
	{!! $errors->first('date_vente','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Nom', 'Nom: ')  }}
	<input type="text" name="campagne" 
	 placeholder="Intitule Campagne" value=" {{old('campagne')?? $ventes->campagne}}"
	 class="form-control">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
    {{ Form::label('Quantite', 'Quantite: ')  }}
	<input type="number" name="quantite" 
	placeholder="nombre de poulets vendus"
	 value="{{old('quantite')?? $ventes->quantite}}"
	 class="form-control">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	</div>
	
	<div class="form-group">
	{{ Form::label('Prix U', 'Prix U: ')  }}
	<input type="number" name="priceUnitaire"  placeholder="Prix Unitaitre" 
	value="{{old('priceUnitaire')?? $ventes->priceUnitaire}}" class="form-control">
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
	</div>
	 <div class="form-group">
	 {{ Form::label('Acheteur', 'Acheteur: ')  }}
	 <input type="text" name="acheteur"  placeholder="Type Acheteur"
	  value="{{old('acheteur')?? $ventes->acheteur}}" class="form-control">
	{!! $errors->first('acheteur','<span class="error-msg">:message</span>') !!}
	 </div>
	 
	 <div class="form-group">
	 {{ Form::label('Contact', 'Contact: ')  }}
	 <input type="text" name="contact"  placeholder="01-02-03-04-05"
	  value="{{old('contact')?? $ventes->contact}}" class="form-control">
	{!! $errors->first('contact','<span class="error-msg">:message</span>') !!}
	 </div>
	
    <div class="form-group">
	{{ Form::label('Event', 'Events: ')  }}
	<input type="text" name="events"  placeholder="type event" 
	value="{{old('events')?? $ventes->events}}" class="form-control">
	{!! $errors->first('events','<span class="error-msg">:message</span>') !!}
	</div>
	
    <div class="form-group">
	{{ Form::label('Avance', 'Avance: ')  }}
	<input type="number" name="avance" placeholder="Avance" 
	value="{{old('avance')?? $ventes->avance}}" class="form-control">
	{!! $errors->first('avance','<span class="error-msg">:message</span>') !!}
	</div>

	<div class="form-group">
	 {{  Form::label('impaye', 'Impaye: ')  }}
	<input type="number" name="impaye" placeholder="Impaye" 
	 value="{{old('impaye')?? $ventes->impaye}}" class="form-control">
	{!! $errors->first('impaye','<span class="error-msg">:message</span>') !!}
	</div>

	<div class="form-group">
	{{  Form::label('Obs', 'Obs: ')  }}
	<textarea name="obs" placeholder="obs"
	 value="{{old('obs')?? $ventes->obs}}" class="form-control">{{old('obs')?? $ventes->obs}}</textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	</div>

	<input type="submit" value="Editer Vente">
</form>

<script>
function validateForm() {
	let errors=[];
let datecreate = document.forms["myForm"]["campagne_id"].value;
let campagne = document.forms["myForm"]["campagne"].value;
let qte = document.forms["myForm"]["quantite"].value;
let pu = document.forms["myForm"]["priceUnitaire"].value;
let avance = document.forms["myForm"]["avance"].value;
let impaye = document.forms["myForm"]["impaye"].value;

if (!datecreate.length >0) {
    errors.push('ID campagne   maquant.\n');

    }
if(!campagne.length >0){
	
	errors.push('Nom Campagne maquant.\n');
}
if (!qte.length >0) {
	
	errors.push('Quantite maquante.\n');
}
if (!pu.length >0) {
	
	errors.push('Prix Unitaire maquant.\n');
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