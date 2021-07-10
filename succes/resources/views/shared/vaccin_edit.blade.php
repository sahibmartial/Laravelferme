<h2>Modifiez Vaccin#{{ $suivi->id}}</h2>
<form name="myForm" action="{{route('vaccins.update',$suivi)}}" method="POST">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	<div class="form-group">
	{{ Form::label('ID', 'ID:') }}
	<input type="text" name="campagne_id" placeholder="Entrez ID"
	 value="{{old('campagne_id')?? $suivi->campagne_id}}" class="form-control">
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
	</div>
 
	<div class="form-group">
	{{ Form::label('Campagne', 'Campagne:') }}
	<input type="text" name="campagne" placeholder="Entrez nom campagne " 
	value="{{old('campagne')?? $suivi->campagne }}" class="form-control">	
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}

	</div>
	<div class="form-group">
	{{ Form::label('DateVaccin', 'Date Traitement:') }}
	<input type="date" name="datevaccination" 
	value="{{old('datevaccination')?? $suivi->datedevaccination }}" class="form-control">
	{!! $errors->first('datevaccination','<span class="error-msg">:message</span>') !!}
	</div>
 
  <div class="form-group">  
	  <input type="text" value="{{$suivi->intitulevaccin }}" disabled>                                                                                   
		<select name="intitulevaccin" class="select">
		<option selected>Traitements</option>
		<option value="Arrivée des poussins">Arrivée des poussins</option>
		<option value="Antibiotique">Antibiotiques</option>
		<option value="Vitamines">Vitamines</option>
		<option value="Vaccin">Vaccins</option>
		<option value="Anticoccidien">Anticoccidiens</option>
		<option value="Maladies Respiratoires">Maladies Respiratoires</option>
	</select>
	</div>
    <div class="form-group">
	{{ Form::label('Obs', 'Observation:') }}
	<textarea name="obs" placeholder="RAS" class="form-control">{{old('obs')?? $suivi->obs }}</textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	</div>
	<!--<input type="submit" value="Modifiez">-->
	<button type="submit" onclick="validateForm()" class="btn btn-success">Modifiez</button>
		
</form>

<script>
function validateForm() {

let errors=[];
let id = document.forms["myForm"]["campagne_id"].value;
let nom = document.forms["myForm"]["campagne"].value;
let dateV = document.forms["myForm"]["datevaccination"].value;
let intituleV = document.forms["myForm"]["intitulevaccin"].value;
let obs = document.forms["myForm"]["obs"].value;


if (!id.length >0) {
	
	errors.push('ID manquant.\n');
}
if (!nom.length >0) {
	
	errors.push('Campagne manquante.\n');
}
if (!dateV.length >0) {
	
	errors.push('Date Traitement manquant.\n');
}
if (!intituleV.length >0) {
	
	errors.push('Intitule Vaccin manquant.\n');
}
if (!obs.length >0) {
	
	errors.push('Observation manquante.\n');
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