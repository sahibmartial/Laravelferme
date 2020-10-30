<?php
use App\Http\Controllers\AlimentController;
$alim= new AlimentController();
$id=$_GET['id'];
$results=$alim->selectAllAlimentforthisCampagne($id);
//$index=$campagnes->id;
//dd($results);
?>
@extends('layout.app')
@section('title')
<title>Aliments</title>
@stop
@section('contenu')
@include('shared.alimentsforthiscampagne')
@stop
@section('retour')
<p><a href="/achats">Achats</a></p>
@endsection
