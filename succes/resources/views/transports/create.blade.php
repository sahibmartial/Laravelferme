@extends('layout.addmorealiments')
@section('title')
<title>TRANSPORT</title>
@stop

@section('contenu')
@include('shared.formtransport')
@stop

@section('retour')
<p><a href="/achats"> Retour Achats</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop