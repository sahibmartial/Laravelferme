<h2>Editer campagne #{{ $campagnes->id}}</h2>
<form name="myForm"  action="{{route('campagnes.update',$campagnes)}}" onsubmit="validateForm()" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}

	<div class="form-group">
	{{  Form::label('Campagne', 'Campagne: ')  }}
	<input type="text" name="title" placeholder="Entrez votre titre"
	 value="{{ old('title')?? $campagnes->intitule}}" class="form-control">
	 {!! $errors->first('title','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{  Form::label('Budget', 'Budget: ')  }}
	<input type="integer" name="budget" placeholder="Entrez votre budget" 
	value="{{ old('budget')?? $campagnes->budget}}" class="form-control">
	{!! $errors->first('budget','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{  Form::label('Statut', 'Statut: ')  }}
	<input type="text" name="status" cols="20" rows="10" 
	placeholder="EN COURS" value=" {{old('status')?? $campagnes->status}}" class="form-control">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}
	</div>

	<div class="form-group">
	{{  Form::label('Observations', 'Observations: ')  }}
	<textarea name="obs" placeholder="RAS" 
	value=" {{old('obs')?? $campagnes->obs}}" class="form-control"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}

	</div>
	<input type="submit" value="Modifier campagne">
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