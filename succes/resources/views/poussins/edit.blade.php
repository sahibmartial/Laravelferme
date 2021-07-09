@extends('base')
@section('content')

<div class="text-center mt-4 mb-4">
	<h3>Modifier Achat Poussins #{{ $poussin->id}}</h3>
<form  name="myForm" action="{{route('poussins.update',$poussin)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<div class="form-group"> 
		
   {{ Form::label('Date', 'Date:') }}
                        
                           <input type="date" name="date_achat" placeholder="" class="form-control"
                           @error('date_achat') is-invalid @enderror" name="date_achat" value="{{old('date_achat')?? $poussin->date_achat }}" required >
                           @error('date_achat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
    </div>

	<div class="form-group">
	{{ Form::label('ID', 'ID:') }}
	<input type="text" name="campagne_id" placeholder="Entrez ID" value="{{ old('campagne_id')?? $poussin->campagne_id}}" class="form-control">
	 	
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
	</div>
	
	<div class="form-group">
	{{ Form::label('Campagne', 'Campagne:') }}
	<input type="text" name="campagne" placeholder="Entrez votre titre" 
	value="{{old('campagne')?? $poussin->campagne}}" class="form-control">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Quantite', 'Quantite:') }}
	<input type="text" name="quantite" cols="20" rows="10" placeholder="quantite" 
	value=" {{old('quantite')?? $poussin->quantite}}" class="form-control">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Prix Unitaire', 'Prix Unitaire:') }}
	<input type="text" name="priceUnitaire" cols="20" rows="10" placeholder="priceUnitaire"
	 value=" {{old('priceUnitaire')?? $poussin->priceUnitaire}}" class="form-control">
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
	</div>
    <div class="form-group">
	{{ Form::label('Fournisseur', 'Fournisseur:') }}
	<input type="text" name="fournisseur" cols="20" rows="10" placeholder="Fournisseur" 
	value=" {{old('fournisseur')?? $poussin->fournisseur}}" class="form-control">
	{!! $errors->first('fournisseur','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	{{ Form::label('Contact', 'Contact:') }}
	<input type="text" name="fournisseur" cols="20" rows="10" placeholder="Fournisseur" 
	value=" {{old('contact')?? $poussin->phone}}" class="form-control">
	{!! $errors->first('contact','<span class="error-msg">:message</span>') !!}
	</div>
	<div class="form-group">
	<textarea name="obs" placeholder="RAS" value="" class="form-control">{{old('obs')?? $poussin->obs}}</textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	</div>
	<!--<input type="submit" value="Editer Achat Poussin">-->
	<button type="submit"  onclick="validateForm()" class="btn btn-success" >Modifier</button>
</form>
<hr>
<p><a href="{{route('head')}}">Accueil Poussins</a></p>
</div>

<script>
function validateForm() {
          let errors=[];
          let datecreate = document.forms["myForm"]["date_achat"].value;
          let campagne = document.forms["myForm"]["campagne"].value;
          let qte = document.forms["myForm"]["quantite"].value;
          let pu = document.forms["myForm"]["priceUnitaire"].value;
          let fournisseur = document.forms["myForm"]["fournisseur"].value;
          let contact = document.forms["myForm"]["contact"].value;
          let obs = document.forms["myForm"]["obs"].value;

          if (!datecreate.length >0) {
              errors.push('Date  maquante.\n');

              }
          if(!campagne.length >0){
            
            errors.push('Campagne manquante.\n');
          }
          if (!qte.length >0) {
            
            errors.push('Quantite manquante.\n');
          }
          if (!pu.length >0) {
            
            errors.push('Prix Unitaire manquant.\n');
          }
          if (!fournisseur.length >0) {
            
            errors.push(' Fournisseur manquant.\n');
          }
          if (!contact.length >0) {
            
            errors.push('Contact Fournisseur  manquant.\n');
          }

          if (errors.length>0) {
            event.preventDefault();
            alert(errors)
          }
         
}

</script>
@stop
