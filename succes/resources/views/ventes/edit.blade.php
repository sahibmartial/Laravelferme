@extends('layout.addmorealiments')
@section('title')
<title>VENTE</title>
@stop

@section('contenu')
@include('shared.vente_edit')
@stop

@section('retour')
<p><a href="{{route('vente')}}">Listing Vente</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop