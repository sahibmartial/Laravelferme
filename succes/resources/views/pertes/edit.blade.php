@extends('layout.addmorealiments')
@section('contenu')
<h1>Editer  Perte #{{ $pertes->id}}</h1>
<form action="{{route('pertes.update',$pertes)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<div>
   {{ Form::label('Date', 'Date:') }}
                            <br>
                           <input type="date" name="date_die" placeholder=""
                           @error('date_die') is-invalid @enderror" name="date_die" value="{{ old('date_die') }}" required autocomplete="date_die" autofocus>
                           @error('date_die')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
	<input type="text" name="campagne_id" placeholder="Entrez ID" value="{{ old('campagne_id')?? $pertes->campagne_id}}">

	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="campagne" placeholder="Entrez votre titre" value="{{ old('campagne')?? $pertes->campagne}}">
	
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="quantite" cols="20" rows="10" placeholder="quantite" value=" {{old('quantite')?? $pertes->quantite}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer Perte">
</form>
<br>
<p><a href="{{route('perte')}}">Accueil</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop