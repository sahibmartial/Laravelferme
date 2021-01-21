<?php
use App\Http\Controllers\TransportController;
$frais= new TransportController();
$id=$_GET['id'];
$results=$frais->selectAllFraisTrasnportForOneCampagne($id);
//$index=$campagnes->id;
//dd($results);
?>
@extends('base')
@section('title')
<title>Transport</title>
@stop

@section('content')
<h3 class="text-center">Detail-Frais-Campagne</h3>
@php
//dd($results);
if(count($results)>0){
@endphp
	<div class="text-center mt-4">
@include('shared.fraisforthiscampagne')
@php
}
else{
"Aucun frais declaré pour cette campagne";
}
@endphp
<hr>
<p><a href="/achats">Achats</a></p>
</div>
@stop
