<?php
use App\Http\Controllers\AccessoireController;
$acc= new AccessoireController();
$id=$_GET['id'];
$results=$acc->selectAllAccessoireforthisCampagne($id);
$total=$acc->calculateDepenseAccessoireofthiscampagne($id);
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
    <th>Date</th>
    <th>Campagne</th>
    <th>Libelle</th>
    <th>Quantite</th>
     <th>PrixUnitaire</th>
    <th>Observations</th>
     <th>Depenses</th>
     </tr>
  <?php
  for ($i=0; $i <count($results) ; $i++) { 
  ?>
  <tr>
    <td>{{ $results[$i]->date_achat}}</td>
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
    <tr><th colspan="7">Total :</th> 
      <td>{{$total}}</td>
    </tr>
</table> 
@stop
<br>
@section('retour')
<p><a href="/achats">Achats</a></p>
@endsection