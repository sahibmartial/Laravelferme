@extends('base')
<?php
  $result = array();
 use App\Http\Controllers\CampagneController;
//echo "string";
$cam= new CampagneController();
 $id=$cam->getCampagneenCours();
  //$var= $id->toJson();
 // dump($id);
 for ($i=0; $i <$id->count(); $i++) {
 	//dump($id[$i]->id);
 	 $result[]=$id[$i]->intitule;
 }
//dump( $result);
  ?>
@section('title')
<title>ACHATS-POUSSINS</title>
@endsection
@section('content')
  <div class="text-center mt-4 mb-4">
    <h3>Achat de poussins</h3>
    @if ($message = Session::get('success'))
       <div class="alert alert-success">
          <p>{{ $message }}</p>
       </div>
    @endif

<form name="myForm" action="{{route('poussins.store')}}"  method="POST">
  {{ csrf_field() }}
  {{--<input type="text" name="campagne_id"  placeholder="Entrez ID " value={{ old('campagne_id') }} >
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}

      <div class="form-group">
         {{ Form::label('Date', 'Date:') }}
                           <input type="date" name="date_achat" placeholder="" class="form-control"
                           @error('date_achat') is-invalid @enderror" name="date_achat" value="{{ old('date_achat') }}" required autocomplete="date_achat" autofocus>
                           @error('date_achat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
       </div>
       <div class="form-group">
       <!-- {{ Form::label('Campagne', 'Campagne:') }}
      <input type="text" name="campagne" id="campagne" placeholder="Entrez nom campagne " class="form-control" >-->
       {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
       <select class="form-select" aria-label="Default select example" name="campagne" id="campagne">
            <option selected>CampagneX</option>
               @foreach ($campagnes as $campagne)
                   <option value="{{ $campagne->intitule }}">{{ $campagne->intitule }}</option>
               @endforeach

           </select>
       </div>

       <div class="form-group">
       {{ Form::label('Quantite', 'Quantite:') }}
        <input type="number" name="quantite" placeholder="Entrez la quantite " class="form-control" value={{ old('quantite') }}>
        {!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
       </div>
       <div class="form-group">
       {{ Form::label('Prix Unitaire', 'Prix Unitaire:') }}
       <input type="number" name="priceUnitaire" placeholder="Prix Unitaire " class="form-control" value="">
       {!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
       </div>

       <div class="form-group">
       {{ Form::label('Fournisseur', 'Fournisseur:') }}
       <input type="text" name="fournisseur" placeholder="Fournisseur" class="form-control">
        {!! $errors->first('fournisseur','<span class="error-msg">:message</span>') !!}
       </div>

       <div class="form-group">
       {{ Form::label('Contact', 'Contact:') }}
       <input type="text" name="contact" placeholder="uu-vv-xx-yy-zz" class="form-control">
        {!! $errors->first('fournisseur','<span class="error-msg">:message</span>') !!}
       </div>

       <div class="form-group">
       {{ Form::label('Observations', 'Observations:') }}
       <textarea name="obs" placeholder="RAS" class="form-control"></textarea>
        {!! $errors->first('obs','<span class="error-msg">:message</span>') !!}

       </div>
      <button type="submit"  onclick="validateForm()" class="btn btn-success" >Enregister</button>
    <!-- <input type="submit"  onclick="text()" value="Enregister quantite" id="bouton_envoi">-->
</form>
<br>
<p><a href="{{route('poussins.index')}}">Lister achats poussins</a></p>

<p><a href="/achats"> Retour Achats</a></p>

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
          if(campagne=='CampagneX'){

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
         // console.log(errors)

}

</script>

@stop

