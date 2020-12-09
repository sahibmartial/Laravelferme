@extends('layout.addmorealiments')
<?php 
use App\Campagne;
use App\Http\Controllers\CampagneController;
  $result = array();
//echo "string";
$cam= new CampagneController();
 $id=$cam->getCampagneenCours();
  //$var= $id->toJson();
 // dump($id);
 for ($i=0; $i <$id->count(); $i++) { 
 	//dump($id[$i]->id);
 	 $result[]=$id[$i]->intitule;
 }

//echo "string";
$cam= new Campagne();
 $id=$cam::all();
  $var= $id->toJson();
  ?>
@section('title')
<title>ACHATS-Bilan En Cours</title>
@endsection
@section('contenu')
<h2> Bilan campagne en cours </h2>
@include('shared.infos_one_campagne_form')
@stop
<br>
@section('retour')
<p><a href="/ferme"> Retour Menu</a></p>
@endsection

@section('footer')
@include('layout.partials.footer')
@stop
