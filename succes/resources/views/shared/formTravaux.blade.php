<div class="text-center">
<h2>Enregistrement Matériels: </h2>
<form id="myForm" name="myForm" action="{{route('travaux.store')}}" method="POST">
  {{ csrf_field() }}
    <div class="form-group">
      {{ Form::label('Date', 'Date:') }}
          <input type="date" name="date_achat" placeholder=""
              @error('date_achat') is-invalid @enderror" name="date_achat" 
              value="{{old('date_achat') }}" required  class="form-control">
                 @error('date_achat')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                  @enderror
                            
    </div>
    <div class="form-group"> 
    {{ Form::label('Libelle', 'Libelle:') }}    

      <input type="text" name="materiel" id="materiel"
       placeholder="Entrez nom materiel" class="form-control">
     {!! $errors->first('materiel','<span class="error-msg" role="alert">:message</span>') !!}
     </div>
    <div class="form-group">
    {{ Form::label('Quantite', 'Quantite:') }}
     <input type="number" name="quantite" placeholder="Entrez la quantite" 
     value="{{old('quantite') }}" class="form-control">
     {!! $errors->first('quantite','<span class="error-msg" role="alert">:message</span>') !!}
    </div>
  <div class="form-group">
  {{ Form::label('Prix', 'Prix Unit:') }}
    <input type="number" name="priceUnitaire" placeholder="Prix Unitaire "
     value="{{ old('priceUnitaire') }}" class="form-control">
    {!! $errors->first('priceUnitaire','<span class="error-msg" role="alert" >:message</span>') !!}
  </div>
  <div class="form-group"> 
  {{ Form::label('Obs', 'Observation:') }}
  <textarea name="obs" placeholder="RAS" class="form-control"></textarea>
  {!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
  </div>
  
  <!--<input type="submit"  onclick="validateForm()" value="Validez" >-->
  <button type="submit" onclick="validateForm()" class="btn btn-success">Validez</button>
</form>
<br>
<p><a href="{{route('travaux.index')}}">Lister Materiels</a></p>
</div>

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