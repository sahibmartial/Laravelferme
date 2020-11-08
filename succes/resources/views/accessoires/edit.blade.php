@extends('layout.addmorealiments')
@section('title')
<title>Accessoires</title>
@stop
@section('contenu')
<h1>Editer  Achat Accessoire #{{ $accessoires->id}}</h1>
<form action="{{route('accessoires.update',$accessoires)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
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
	<input type="text" name="campagne_id" placeholder="Entrez ID" value="{{ old('campagne_id')?? $accessoires->campagne_id}}">
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="campagne" placeholder="Entrez votre titre" value="{{ old('campagne')?? $accessoires->campagne}}">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="libelle" cols="20" rows="10" placeholder="libelle" value=" {{old('libelle')?? $accessoires->libelle}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="number" name="quantite" cols="20" rows="10" placeholder="quantite" value=" {{old('quantite')?? $accessoires->quantite}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="number" name="priceUnitaire" cols="20" rows="10" placeholder="priceUnitaire" value=" {{old('priceUnitaire')?? $accessoires->priceUnitaire}}">
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
	<br>
	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer Achat Accessoires">
</form>
@stop
<br>
@section('retour')
<p><a href="{{route('accessoires.index')}}">Accueil</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop