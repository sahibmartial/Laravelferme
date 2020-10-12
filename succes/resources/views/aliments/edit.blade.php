@extends('layout.app')
@section('title')
<title>ALIMENTS</title>
@stop

@section('contenu')
@include('shared.editaliment')
@stop

@section('retour')
<p><a href="{{route('aliments.index')}}">Liste Aliments</a></p>
@stop