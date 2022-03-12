<h2>Créer une campagne</h2>
<form  name="myForm" action="{{route('campagnes.store')}}" onsubmit="validateForm()" method="POST">
	{{ csrf_field() }}

     <div class="form-group">
	 {{  Form::label('Campagne', 'Campagne: ')  }}
	 <input type="text" name="title" placeholder="Entrez nom campagne: campagneX "
	 value="{{ old('title') }}" class="form-control">
	{!! $errors->first('title','<span class="error-msg">:message</span>') !!}
	 </div>
	<div class="form-group">
	{{  Form::label('Budget', 'Budget: ')  }}
	<input type="integer" name="budget" placeholder="Entrez le budget" class="form-control">
	{!! $errors->first('budget','<span class="error-msg">:message</span>') !!}
	</div>
   <div class="form-group">
   {{  Form::label('Statut', 'Statut: ')  }}
    <input type="text" name="status" placeholder="" value="EN COURS" class="form-control">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}
   </div>

   <div class="form-group">
   {{  Form::label('Observations', 'Observations: ')  }}
   <textarea name="obs" placeholder="RAS" class="form-control"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
   </div>
	<input type="submit" value="Créer Campagne" class="btn btn-success">

</form>

<script>
function validateForm() {
let errors=[];

let campagne = document.forms["myForm"]["title"].value;
let budget = document.forms["myForm"]["budget"].value;
let statut = document.forms["myForm"]["status"].value;



if(!campagne.length >0){

	errors.push('Campagne manquante.\n');
}
if (!budget.length >0) {

	errors.push('Budget manquante.\n');
}
if (!statut.length >0) {

	errors.push('Statut manquant.\n');
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
