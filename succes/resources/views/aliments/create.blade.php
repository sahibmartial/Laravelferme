@extends('layout.addmorealiments')
@section('title')
<title>ALIMENTS</title>
@stop

@section('contenu')
@include('shared.formaliment')
@stop
@section('retour')
<p><a href="/achats"> Retour Achats</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop