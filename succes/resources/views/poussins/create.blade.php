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
<form id="completion_form" action="{{route('poussins.store')}}" method="POST">
  {{ csrf_field() }}
  {{--<input type="text" name="campagne_id"  placeholder="Entrez ID " value={{ old('campagne_id') }} >
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}
    <div>
  {{ Form::label('Date', 'Date:') }}
                            <br>
                           <input type="date" name="date_achat" placeholder=""
                           @error('date_achat') is-invalid @enderror" name="date_achat" value="{{ old('date_achat') }}" required autocomplete="date_achat" autofocus>
                           @error('date_achat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
  <input type="text" name="campagne" id="campagne" placeholder="Entrez nom campagne " onKeyUp="check(this)" onChange="check(this)">
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
    <br>
  <input type="number" name="quantite" placeholder="Entrez la quantite " value={{ old('quantite') }}>
  {!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="number" name="priceUnitaire" placeholder="Prix Unitaire " value={{ old('priceUnitaire') }}>
  {!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="text" name="fournisseur" placeholder="Fournisseur">
  {!! $errors->first('fournisseur','<span class="error-msg">:message</span>') !!}
  <br>
  <textarea name="obs" placeholder="RAS"></textarea>
  {!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="submit"  onclick="text()" value="Enregister quantite" id="bouton_envoi">
</form>
<br>
<p><a href="{{route('poussins.index')}}">Lister achats poussins</a></p>
<hr>
<p><a href="/achats"> Retour Achats</a></p>
    
  </div>

@stop

