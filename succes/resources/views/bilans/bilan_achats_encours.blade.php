@extends('base')
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
<title>ACHATS-Bilan</title>
@endsection
@section('content')
<div class="col-lg-0 mt-2">
	<p><a href="/ferme"> Retour Menu</a></p>
</div>
<div class="text-center mt-2">
	<h3> Bilan campagne en cours </h3>
@include('shared.infos_one_campagne_form')
</div>
@stop



