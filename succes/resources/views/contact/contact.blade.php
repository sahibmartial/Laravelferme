@extends('base')
@section('title')
<title>Contact - Ferme Maya</title>
@stop
@section('content')
@if($notification ?? '')
 <div class="alert alert-info mt-3">{{$notification}}</div>
@endif
<h2 class="mt-4">Nous contacter</h2>
<form action="{{route('sendcontact')}}" method="POST">
	{{ csrf_field() }}
	<input type="text" id="nom" name="nom" placeholder="Entrez votre nom ">
	{!! $errors->first('nom','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="email" id="eamil" name="email" placeholder="Votre mail">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}
	<br>
  	<textarea name="content" placeholder="vottre message"></textarea>
	{!! $errors->first('content','<span class="error-msg">:message</span>') !!}
	<br>
	<input class="btn btn-primary" type="submit" value="Nous Contacter">
</form>

@stop