<h2>Modifiez Materiel#{{ $materiel['id']}}</h2>
<form   name="myForm" action="{{route('travaux.update',$materiel)}}" method="POST">
	{{ csrf_field() }}
	{{ method_field('PUT')}}	
    <div class="form-group">
    {{ Form::label('Date', 'Date:') }}
    <input type="date" name="date"
     value="{{old('date')?? $materiel->date }}" class="form-control">
	{!! $errors->first('date','<span class="error-msg">:message</span>') !!}
    </div>
    <div class="form-group"> 
    {{ Form::label('Libelle', 'Libelle:') }}    

     <input type="text" name="materiel" id="materiel" 
      value="{{old('materiel')?? $materiel->materiel }}" class="form-control">
     {!! $errors->first('materiel','<span class="error-msg" role="alert">:message</span>') !!}
     </div>

     <div class="form-group">
    {{ Form::label('Quantite', 'Quantite:') }}
      <input type="number" name="quantite" 
      value="{{old('quantite') ?? $materiel->quantite }}" class="form-control">
       {!! $errors->first('quantite','<span class="error-msg" role="alert">:message</span>') !!}
     </div>
    <div class="form-group">
     {{ Form::label('Prix', 'Prix Unit:') }}
    <input type="number" name="priceUnitaire" 
    value="{{old('PriceUnitaire')?? $materiel->PriceUnitaire}}" class="form-control">
      {!! $errors->first('priceUnitaire','<span class="error-msg" role="alert" >:message</span>') !!}
    </div>
	
    <div class="form-group">
    {{ Form::label('Obs', 'Observation:') }}
  	<textarea name="obs" placeholder="RAS" class="form-control">{{old('obs')?? $materiel->obs }}</textarea>
    	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
    </div>	
    <!--	<input type="submit" value="Modifiez">-->
    <button type="submit" onclick="validateForm()" class="btn btn-success">Modifiez</button>
</form>


<script>
function validateForm() {

let errors=[];
let date_achat = document.forms["myForm"]["date_achat"].value;
let nom = document.forms["myForm"]["materiel"].value;
let qte = document.forms["myForm"]["quantite"].value;
let pu = document.forms["myForm"]["priceUnitaire"].value;


if (!date_achat.length >0) {
	
	errors.push('Date manquante.\n');
}
if (!nom.length >0) {
	
	errors.push('Libelle manquant.\n');
}
if (!qte.length >0) {
	
	errors.push('Quantite manquante.\n');
}
if (!pu.length >0) {
	
	errors.push('Prix unitaire manquant.\n');
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