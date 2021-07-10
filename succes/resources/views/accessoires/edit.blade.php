@extends('base')
@section('title')
<title>Accessoires</title>
@stop
@section('content')

<div class="text-center mt-4 mb-4 ">
	<h3>Modification  Achat Accessoire #{{ $accessoires->id}}</h3>
<form name="myForm" action="{{route('accessoires.update',$accessoires)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<div class="form-group">
      {{ Form::label('Date', 'Date:') }}

        <input type="date" name="date_achat" placeholder=""
                @error('date_achat') is-invalid @enderror" name="date_achat" 
				value="{{old('date_achat')?? $accessoires->date_achat }}" required class="form-control" >
                    @error('date_achat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                            
    </div>
	<div class="form-group">
	{{ Form::label('ID', 'ID:') }}
	<input type="text" name="campagne_id" placeholder="Entrez ID" 
	value="{{old('campagne_id')?? $accessoires->campagne_id}}" class="form-control">
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Campagne', 'Campagne:') }}
	<input type="text" name="campagne" placeholder="Entrez votre titre" 
	value="{{old('campagne')?? $accessoires->campagne}}" class="form-control">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Libelle', 'Libelle:') }}
	<input type="text" name="libelle"  placeholder="libelle" 
	value="{{old('libelle')?? $accessoires->libelle}}" class="form-control">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	</div>
    <div class="form-group">
	{{ Form::label('Quantite', 'Quantite:') }}
	<input type="number" name="quantite"  placeholder="quantite" 
	value="{{old('quantite')?? $accessoires->quantite}}" class="form-control">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	</div>
    <div class="form-group">
	{{ Form::label('PU', 'Prix Unitaire:') }}
	<input type="number" name="priceUnitaire" placeholder="priceUnitaire" 
	value="{{old('priceUnitaire')?? $accessoires->priceUnitaire}}" class="form-control">
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Obs', 'Observations:') }}
	<textarea name="obs" placeholder="RAS" class="form-control">{{old('obs')?? $accessoires->obs}}</textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	</div>
	
	<!--<input type="submit" value="Editer Achat Accessoire">-->
	<button type="submit" onclick="validateForm()" class="btn btn-success">Editer Achat Accessoire</button>
</form>
<hr>
<p><a href="{{route('accessoires.index')}}">Accueil</a></p>

</div>
<script>
function validateForm() {
let errors=[];
let date_achat = document.forms["myForm"]["date_achat"].value;
let id_camp = document.forms["myForm"]["campagne_id"].value;
let camp = document.forms["myForm"]["campagne"].value;
let libelle = document.forms["myForm"]["libelle"].value;
let qte = document.forms["myForm"]["quantite"].value;
let pu = document.forms["myForm"]["priceUnitaire"].value;

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
@stop



