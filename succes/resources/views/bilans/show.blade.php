<?php
//$index=$campagnes->id;
?>
@extends('layout.app')
@section('title')
<title>BILAN</title>
@stop
@section('contenu')
@include('shared.bilanshow')
<p><a href="{{ route('bilans.edit', $bilans)}}">Modifier Bilan</a>
</p>

<p><a href="{{route('home')}}">Accueil</a></p>
@stop