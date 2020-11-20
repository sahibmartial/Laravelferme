
<?php 
use App\Campagne;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\TransportController;
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
   $campagne =$_POST['campagne'];

 // $campagne="campagne5";
        $campagne_id=0;
        $cam= new CampagneController();
        $frais= new TransportController();
       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($campagne));
       $results=$frais->selectAllFraisTrasnportForOneCampagne($campagne_id);

       $total=$frais->calculateFraisTotalOfCampagne($campagne_id);

      //dump($results);
      // dd($total);


  ?>
@extends('layout.addmorealiments')
@section('title')
<title>ACHATS-FraisTransport</title>
@endsection
@section('contenu')
<table style="width:100%">
  <caption>All frais de trasports For this campagne</caption>
  <tr>
    <th>ID</th>
    <th>Date</th>
    <th>Campagne</th>
    {{--<th>Libelle</th>--}}
    {{--<th>Quantite</th>--}}
     <th>Montant</th>
    <th>Observations</th>
     <th>Depenses</th>
     </tr>
  <?php
  for ($i=0; $i <count($results) ; $i++) { 
  ?>
  <tr>
     
    <td>{{ $results[$i]->campagne_id}}</td>
    <td>{{ $results[$i]->date_achat}}</td>
    <td>{{ $results[$i]->campagne}}</td>
    {{--<td>{{ $results[$i]->libelle}}</td>--}}
    {{--<td>{{ $results[$i]->quantite}}</td>--}}
    <td>{{ $results[$i]->montant}}</td>
     <td>{{ $results[$i]->obs}}</td>
  </tr>
  <?php
  }
    ?>
    <tr><th colspan="5">Total :</th> 
      <td>{{$total}}</td>
    </tr>
</table> 
@stop

@section('retour')
<br>
<p><a href="/achats"> Retour Achats</a></p>
@endsection

@section('footer')
@include('layout.partials.footer')
@stop