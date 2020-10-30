<?php
use App\Http\Controllers\AccessoireController;
$acc= new AccessoireController();
$id=$_GET['id'];
$results=$acc->selectAllAccessoireforthisCampagne($id);
//$index=$campagnes->id;
//dd($result);
?>
@extends('layout.app')
@section('title')
<title>Accessoires</title>
@stop
@section('contenu')
<table style="width:100%">
  <caption>All Accesssoires For this campagne</caption>
  <tr>
    <th>ID</th>
    <th>Campagne</th>
    <th>Libelle</th>
    <th>Quantite</th>
     <th>PrixUnitaire</th>
    <th>Observations</th>
  </tr>
  <?php
  for ($i=0; $i <count($results) ; $i++) { 
  ?>
  <tr>
    <td>{{ $results[$i]->campagne_id}}</td>
    <td>{{ $results[$i]->campagne}}</td>
    <td>{{ $results[$i]->libelle}}</td>
    <td>{{ $results[$i]->quantite}}</td>
    <td>{{ $results[$i]->priceUnitaire}}</td>
     <td>{{ $results[$i]->obs}}</td>
  </tr>
  <?php
  }
    ?>
</table> 
@stop
@section('retour')
<p><a href="/achats">Achats</a></p>
@endsection