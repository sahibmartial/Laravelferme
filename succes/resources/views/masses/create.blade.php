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
@extends('layout.addmorealiments')
@section('title')
<title>MASSE</title>
@endsection
@section('contenu') 
@include('shared.masse_form')
@stop

@section('retour')
<p><a href="/mean_masse"> Retour Masse</a></p>
@endsection
@section('footer')
@include('layout.partials.footer')
@stop