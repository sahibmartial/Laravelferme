<?php
use App\Http\Controllers\TransportController;
$frais= new TransportController();
$id=$_GET['id'];
$results=$frais->selectAllFraisTrasnportForOneCampagne($id);
//$index=$campagnes->id;
//dd($results);
?>
@extends('layout.app')
@section('title')
<title>Transport</title>
@stop
@section('contenu')
@include('shared.fraisforthiscampagne')
@stop
@section('retour')
<p><a href="/achats">Achats</a></p>
@endsection
