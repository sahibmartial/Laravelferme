
<h2>Editer Achat Aliment #{{ $aliments->id}}</h2>
<form name="myForm" action="{{route('aliments.update',$aliments)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
  
	<div class="form-group">
       {{ Form::label('Date', 'Date:') }}
            <input type="date" name="date_achat" placeholder=""
                @error('date_achat') is-invalid @enderror" name="date_achat" 
				value="{{old('date_achat')?? $aliments->date_achat}}" class="form-control" required>
                    @error('date_achat')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                            
  </div>
  <div class="form-group">
  {{ Form::label('ID', 'ID:') }}
  <input type="text" name="campagne_id" placeholder="Entrez ID"
   value="{{ old('campagne_id')?? $aliments->campagne_id}}" class="form-control" >
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
  </div>
  <div class="form-group">
  {{ Form::label('Campagne', 'Campagne:') }}
  <input type="text" name="campagne" placeholder="Entrez Nom" 
  value="{{ old('campagne')?? $aliments->campagne}}" class="form-control">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  </div>
  <div class="form-group">
  {{ Form::label('Libelle', 'Libelle:') }}
  <input type="text" name="libelle" 
   placeholder="libelle" value="{{old('libelle')?? $aliments->libelle}}" class="form-control">
	{!! $errors->first('libelle','<span class="error-msg">:message</span>') !!}
   </div>
	<div class="form-group">
	{{ Form::label('Quantite', 'Quantite:') }}
	<input type="number" name="quantite"  placeholder="quantite"
	 value="{{old('quantite')?? $aliments->quantite}}" class="form-control">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('PU', 'Prix Unitaire:') }}
	<input type="number" name="priceUnitaire" placeholder="priceUnitaire" 
	value="{{old('priceUnitaire')?? $aliments->priceUnitaire}}" class="form-control">
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Four', 'Fournisseur:') }}
	<input type="text" name="fournisseur" placeholder="Fournisseur" 
	value="{{old('fournisseur')?? $aliments->fournisseur}}" class="form-control">
	{!! $errors->first('fournisseur','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Phone', 'Contact:') }}
	<input type="text" name="contact" placeholder="01-02-03-04-05" 
	value="{{old('contact')?? $aliments->contact}}" class="form-control">
	{!! $errors->first('contact','<span class="error-msg">:message</span>') !!}

	</div>
	<div class="form-group">
	{{ Form::label('Obs', 'Observations:') }}
	<textarea name="obs" placeholder="RAS" class="form-control">{{old('obs')?? $aliments->obs}}</textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	</div>
	<!--<input type="submit" value="Editer Achat Aliment">-->
	<button type="submit" onclick="validateForm()" class="btn btn-success">Editer Achat Aliment</button>
</form>

<script>
function validateForm() {

let errors=[];
let date_achat = document.forms["myForm"]["date_achat"].value;
let id_camp = document.forms["myForm"]["campagne_id"].value;
let camp = document.forms["myForm"]["campagne"].value;
let libelle = document.forms["myForm"]["libelle"].value;
let qte = document.forms["myForm"]["quantite"].value;
let pu = document.forms["myForm"]["priceUnitaire"].value;
let fourni = document.forms["myForm"]["fournisseur"].value;

if (!date_achat.length >0) {
	
	errors.push('Date manquante.\n');
}

if (!id_camp.length >0) {
	
	errors.push('ID manquant.\n');
}

if (!camp.length >0) {
	
	errors.push('Campagne manquante.\n');
}
if (!libelle.length >0) {
	
	errors.push('Libelle manquant.\n');
}
if (!qte.length >0) {
	
	errors.push('Quantite manquante.\n');
}
if (!pu.length >0) {
	
	errors.push('Prix Unitaire manquant.\n');
}
if (!fourni.length >0) {
	
	errors.push('Fournisseur manquant.\n');
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