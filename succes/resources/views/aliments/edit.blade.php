@extends('layout.addmorealiments')
@section('title')
<title>ALIMENTS</title>
@stop

@section('contenu')
@include('shared.editaliment')
@stop
<br>
@section('retour')
<p><a href="{{route('aliments.index')}}">Listing Aliments</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop