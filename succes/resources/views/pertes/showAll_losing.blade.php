
<?php 
use App\Campagne;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\PerteController;
//  $result = array();
//echo "string";
/*$cam= new CampagneController();
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
  $var= $id->toJson();*/

   $campagne =Str::lower($_POST['campagne']);

 // $campagne="campagne5";
        $campagne_id=0;
        $cam= new CampagneController();
        $lost= new PerteController();
       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($campagne));
       $results=$lost->selectAllLossOfThisCampagne($campagne_id);

       $total=$lost->calculateTotalLossofthiscampagne($campagne_id);

    // dump($results);
     //  dd($total);

  ?>

@extends('base')
@section('title')
<title>Tlosses-ofCampaign</title>
@endsection
@section('content')
<div class="text-left"><a href="{{route('pdf_pertes',['data'=>$campagne])}}">download</a></div>
<h3 class="text-center mt-3-mb-2">Detail pertes de la <b>{{$campagne}}</b></h3>
<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Date</th>
      <th scope="col">Campagne</th>
      <th scope="col">Quantite</th>
      <th scope="col">causes</th>
      {{--<th scope="col">Observations</th>--}}
      <th scope="col">TLoss</th>
    </tr>
  </thead>
  <tbody>

   <?php

    for ($i=0; $i <count($results) ; $i++) { 
    ?>
  <tr>
     
    <td>{{ $results[$i]->campagne_id}}</td>
    <td>{{ $results[$i]->date_die}}</td>
    <td>{{ $results[$i]->campagne}}</td>
    <td>{{ $results[$i]->quantite}}</td>
    <td>{{ $results[$i]->cause}}</td>
    {{--<td>{{ $results[$i]->obs}}</td>--}}
  </tr>
  <?php
  }
    ?>
    <tr><th colspan="5">Total :</th> 
      <td>{{$total}}</td>
    </tr>
  </tbody>
</table> 

<hr>
<p class="text-center"><a href="/achats"> Retour Achats</a></p>

@stop



