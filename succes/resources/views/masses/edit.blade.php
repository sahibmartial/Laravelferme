@extends('layout.addmorealiments')
@section('contenu')
<h1>Editer Masse #{{ $masses->id}}</h1>
<form action="{{route('masses.update',$masses)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	{{--<input type="text" name="campagne_id" placeholder="Entrez ID" value="{{ old('campagne_id')?? $masses->campagne_id}}">
	
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
  <br>--}}
	<input type="text" name="campagne" placeholder="Entrez votre titre" value="{{ old('campagne')?? $masses->campagne}}">
	
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="mean_masse" cols="20" rows="10" placeholder="quantite" value=" {{old('mean_masse')?? $masses->mean_masse}}">
	{!! $errors->first('mean_masse','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer  Masse campagne">
</form>
<br>
<p><a href="{{route('masses.index')}}">Accueil</a></p>
@stop

@section('footer')
@include('layout.partials.footer')
@stop