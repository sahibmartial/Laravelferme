<?php 
  $result = array();
 use App\Http\Controllers\CampagneController;
//echo "string";
$cam= new CampagneController();
 $id=$cam->getCampagneenCours();
  //$var= $id->toJson();
 // dump($id);
 for ($i=0; $i <$id->count(); $i++) { 
  //dump($id[$i]->id);
   $result[]=$id[$i]->intitule;
 }
//dump( $result);
  ?>
@extends('base')
@section('title')
<title>MASSE</title>
@endsection
@section('content') 
<div class="text-center mt-4">

@include('shared.masse_form')
<hr>
<p><a href="/mean_masse"> Retour Masse</a></p>
</div>
@stop

