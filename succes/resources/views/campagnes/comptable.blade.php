<?php
$tarted=date("Y-m-d ");
//dd($tarted);
?>
@extends('base')
@section('title')
<title>Apport</title>
@stop
@section('content')
<div >
	<p><a href="{{route('campagnes.index')}}">Accueil</a></p>
</div>
@include('shared.formcapital')
@stop

