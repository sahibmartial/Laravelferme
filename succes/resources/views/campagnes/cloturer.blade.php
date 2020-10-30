@extends('layout.app')
@section('title')
<title>CAMPAGNE</title>
@stop
@section('contenu')
@include('shared.cloture_campagne')
@stop
@section('retour')
<p><a href="{{route('home')}}">Accueil</a></p>
@stop
@section('footer')
@include('layout.partials.footer')
@stop