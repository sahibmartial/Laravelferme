<h2>Masse  de la campagne </h2>
<form name="myForm" action="{{route('masses.store')}}" method="POST">
	{{ csrf_field() }}
	{{--<input type="text" name="campagne_id"  placeholder="Entrez ID " value={{ old('campagne_id') }} >
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}

	<div class="form-group">
	{{ Form::label('Campagne', 'Campagne:') }}
	<input type="text" name="campagne" id="campagne" 
	placeholder="Entrez nom campagne" value="{{ old('campagne') }}" class="form-control">
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Masse', 'Masse:') }}
	<input type="double" name="mean_masse" placeholder="Saisir la masse"
	 value="{{ old('mean_masse') }}"   class="form-control">
	{!! $errors->first('mean_masse','<span class="error-msg">:message</span>') !!}
	
	</div>
	<div class="form-group">
	{{  Form::label('Observations', 'Observations: ')  }}
	<textarea name="obs" placeholder="RAS" class="form-control"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	</div>
	
	<!--<input type="submit" value="Enregister masse" class="btn btn-success">-->
	<button type="submit" onclick="validateForm()" class="btn btn-success">Enregister masse</button>
</form>
<br>
<p><a href="{{route('masses.index')}}">Listing Masse</a></p>
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