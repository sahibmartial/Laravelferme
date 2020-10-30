@extends('layout.addmorealiments')
@section('title')
<title>TRANSPORT</title>
@stop

@section('contenu')
@include('shared.transportedit')
@stop

@section('retour')
<p><a href="{{route('transports.index')}}">Listing Frais</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop