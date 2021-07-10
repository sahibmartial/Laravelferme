
<?php 
use App\Campagne;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\AccessoireController;
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
        $acess= new AccessoireController();
       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($campagne));
       $results=$acess->selectAllAccessoireforthisCampagne($campagne_id);

       $total=$acess->calculateDepenseAccessoireofthiscampagne($campagne_id);

      // dump($results);
    //   dd($total);
?>
@extends('base')
@section('title')
<title>ACHATS-ACCESSOIRES</title>
@endsection
@section('content')
<h4 class="text-center">Achat Accessoires</h4>
<div class="float-sm-left mt-3">
  <p><a href="{{route('pdf_accesoires',['data'=>$campagne])}}" class="btn btn-primary">Download</a></p>
</div>
@if(count($results)>0)
  <table class="table table-bordered">
  <tr>
    <th>ID</th>
    <th>Date</th>
    <th>Campagne</th>
    <th>Libelle</th>
    <th>Quantite</th>
     <th>PrixUnitaire</th>
    <th>Observations</th>
     <th>DepensesT</th>

     </tr>
  <?php
  for ($i=0; $i <count($results) ; $i++) { 
  ?>
  <tr>
    <td>{{$i}}{{--$results[$i]->campagne_id --}}</td>
    <td>{{ $results[$i]->date_achat}}</td>
    <td>{{ $results[$i]->campagne}}</td>
    <td>{{ $results[$i]->libelle}}</td>
    <td>{{ $results[$i]->quantite}}</td>
    <td>{{ $results[$i]->priceUnitaire}}</td>
     <td>{{ $results[$i]->obs}}</td>
    <td><?php echo($results[$i]->quantite*$results[$i]->priceUnitaire); ?> FCFA</td>
  </tr>
  <?php
  }
    ?>
    <tr><th colspan="7">Total :</th> 
      <td><b>{{$total}}</b> FCFA</td>
    </tr>
</table> 
@else
<div class="alert alert-success">
	<p>Aucun Accessoire Enregistres pour la campagne !!! </p>
</div>
@endif

<div class="text-center mt-3">
  <p ><a href="/achats" class="retour">Retour_Achats</a></p>
</div>
@stop


