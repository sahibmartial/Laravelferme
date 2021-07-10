<div class="text-center mt-4">
	
<h2>Modification Bilan #{{ $bilans->campagne}}</h2>
<form name="myForm" name="myForm" action="{{route('bilans.update',$bilans)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<!--
	{{--<input type="text" name="obs" placeholder="Entrez new comment" value="{{ old('obs')?? $bilans->intitule}}">
	
	{!! $errors->first('title','<span class="error-msg">:message</span>') !!}
	<input type="text" name="status" cols="20" rows="10" placeholder="Entre le statut" value=" {{old('status')?? $campagnes->status}}">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}
	<br>--}}
    -->
	<div class="form-group">
	<textarea name="obs" placeholder=" Entez new obs" class="form-control">{{old('obs')?? $bilans->obs}}</textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	</div>
	<!--<input type="submit" value="Editer  Bilan">-->
	<button type="submit" onclick="validateForm()" class="btn btn-success">Editer  Bilan</button>
</form>
</div>
<script>
function validateForm() {

let errors=[];

let obs = document.forms["myForm"]["obs"].value;

if (!obs.length >0) {
	
	errors.push('Observations  manquante.\n');
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


