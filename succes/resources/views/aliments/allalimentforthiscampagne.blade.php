<?php
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\AlimentController;

        $campagne_id=0;
        $cam= new CampagneController();
        $alim= new AlimentController();
        
       //$campagne_id=$cam->getIntituleCampagneenCours(Str::lower($campagne));


$id=$_GET['id'];
$results=$alim->selectAllAlimentforthisCampagne($id);
$total=$alim->calculateDepenseAlimentofthiscampagne($id);

//$index=$campagnes->id;
//dump($id);
//dd($total);

?>
@extends('base')
@section('title')
<title>Aliments</title>
@stop
@section('content')
<div class="text-center mt-4">
	@include('shared.alimentsforthiscampagne')
<p><a href="/achats">Achats</a></p>
</div>

@stop



