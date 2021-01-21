@extends('base')
@section('title')
<title>FERME-MAYA</title>
@endsection
@section('content')
<h3 class="text-center mt-2 mb-2">Board MAYA</h3>

@php

 if(Auth::user()==""){
 @endphp
 
 <p style="color:red">Acccès interdit, clicquer ici <a href="/" class="alert-link">Home</a> Merci. <p> 
 @php
  
 return ;
	
 }

  $json = json_decode(Auth::user()->roles);

 // dump($json) ;
@endphp

@if($json==="admin")
@include('layout.partials.navferme')
@else

@endif


@stop