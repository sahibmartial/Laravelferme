<h2>Editer Apport #{{ $apports->id}}</h2>
<form  name="myForm" action="{{route('apports.update',$apports)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}

	<div class="form-group">
	{{ Form::label('Campagne', 'Campagne:') }}
	<input type="text" name="campagne" placeholder="Entrez le nom de la campagne" 
	value="{{old('campagne')?? $apports->campagne}}" class="form-control">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Apport', 'Apport:') }}
	<input type="integer" name="apport" placeholder="Entrez votre budget"
	 value="{{old('apport')?? $apports->apport}}" class="form-control">
	{!! $errors->first('budget','<span class="error-msg">:message</span>') !!}
	</div>
  
	<!--
  	<textarea name="obs" placeholder="RAS" value=" {{old('obs')?? $apports->obs}}"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
    -->
    <div class="form-group">
		<select name="origineapport" class="custom-select">
		<option selected>Origine des Apports</option>
		<option value="Apport issu de Martial">Apport issu de Martial</option>
		<option value="Apport issu de Edmond">Apport issu de Edmond</option>
		<option value="Apport issu des Ventes">Apport issu des Ventes</option>
		<option value="Autres">Autres</option>
	</select>
	</div>
	<button type="submit" onclick="validateForm()" class="btn btn-success">Déclarez Apport</button>
	<!--<input type="submit" value="Modifiez ">-->
</form>


<script>
function validateForm() {

let errors=[];
let campagne = document.forms["myForm"]["campagne"].value;
let origine = document.forms["myForm"]["origineapport"].value;
let apport = document.forms["myForm"]["apport"].value;



if(!campagne.length >0){
	
	errors.push('Campagne manquante.\n');
}
if (!origine.length >0) {
	
	errors.push('Origine Apport  manquant.\n');
}
if (!apport.length >0) {
	
	errors.push('Apport manquant.\n');
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