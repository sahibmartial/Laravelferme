
<h2>Editer Frais de Transport #{{ $transports->id}}</h2>
<form name="myForm" action="{{route('transports.update',$transports)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<div class="form-group">
	{{ Form::label('Date', 'Date:') }}
	<input type="date" name="date_achat" placeholder="" 
	value="{{old('date_achat')?? $transports->date_achat}}" class="form-control">
	{!! $errors->first('date_achat','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('ID', 'ID:') }}
	<input type="text" name="campagne_id" placeholder="ID" 
	value="{{old('campagne_id')?? $transports->campagne_id}}" class="form-control">
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Campagne', 'Campagne:') }}
	<input type="text" name="campagne"  placeholder="Nom" 
	value="{{old('campagne')?? $transports->campagne}}" class="form-control">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Montant', 'Montant:') }}
	<input type="number" name="montant"  placeholder="Frais" 
	value="{{old('montant')?? $transports->montant}}" class="form-control">
	{!! $errors->first('montant','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Obs', 'Observations:') }}
	<textarea name="obs" placeholder="RAS" class="form-control">{{old('obs')?? $transports->obs}}</textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	</div>
	<!--<input type="submit" value="Modifier Frais">-->
	<button type="submit" onclick="validateForm()" class="btn btn-success">Modifier Transport</button>
</form>
<br>
<script>
function validateForm() {

let errors=[];
let date_achat = document.forms["myForm"]["date_achat"].value;
let nom = document.forms["myForm"]["campagne"].value;
let id = document.forms["myForm"]["campagne_id"].value;
let montant = document.forms["myForm"]["montant"].value;


if (!date_achat.length >0) {
	
	errors.push('Date manquante.\n');
}
if (!id.length >0) {
	
	errors.push('Id manquant.\n');
}

if (!nom.length >0) {
	
	errors.push('Campagne manquante.\n');
}
if (!montant.length >0) {
	
	errors.push('Montant manquante.\n');
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