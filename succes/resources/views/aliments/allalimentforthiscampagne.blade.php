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
