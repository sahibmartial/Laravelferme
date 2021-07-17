<div class="text-center">
<h3>Ajout Apport</h3>
<form name="myForm"   action="{{route('ajoutCapital')}}" method="POST">
	{{ csrf_field() }}
	<div class="form-group">
	{{ Form::label('Campagne', 'Campagne:') }}
	<input type="text" name="campagne" placeholder="Entrez nom campagne " 
	value="{{ old('campagne') }}" class="form-control">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}

	</div>
	<div class="form-group">
	{{ Form::label('Apport', 'Apport:') }}
	<input type="integer" name="apport" placeholder="Entrez votre Apport"
	 value="" class="form-control">
	{!! $errors->first('apport','<span class="error-msg">:message</span>') !!}
	</div>
	<!--
	<br>
  <input type="text" name="status" placeholder="" value="EN COURS">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!
	<br>
	-->
	<div >
		<select name="origineapport" class="custom-select">
		<option selected>Origine des Apports</option>
		<option value="Apport issu de Martial">Apport issu de Martial</option>
		<option value="Apport issu de Edmond">Apport issu de Edmond</option>
		<option value="Apport issu des Ventes">Apport issu des Ventes</option>
		<option value="Autres">Autres</option>
	</select>

	</div>

	<div class="form-group">
	{{ Form::label('Obs', 'Observations:') }}
	<textarea name="obs" placeholder="RAS" class="form-control"></textarea>

	</div>
	<!--<input type="submit" value="Ajouter Apport">-->
	<button type="submit" onclick="validateForm()" class="btn btn-success">Déclarez Apport</button>
	
</form>
</div>


<script>
function validateForm() {
//console.log('hello')
let errors=[];
let campagne = document.forms["myForm"]["campagne"].value;
let apport = document.forms["myForm"]["apport"].value;
let origine = document.forms["myForm"]["origineapport"].value;



if(!campagne.length >0){
	
	errors.push('Campagne manquante.\n');
}
if (!apport.length >0) {
	
	errors.push('Apport manquant.\n');
}
if (!origine.length >0) {
	
	errors.push('Origine Apport manquant.\n');
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
