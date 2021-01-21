<?php

use App\Http\Controllers\AccessoireController;
use App\Http\Controllers\AlimentController;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\PoussinController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\PerteController;
use App\Http\Controllers\GeneratePdfController;

$campagne = $_POST['campagne'];

//$resultcampagne = array('id'=>'','intitule'=>'','status'=>'','date-creation'=>'');
//echo "string";
$cam         = new CampagneController();
$acess       = new AccessoireController();
$food        = new AlimentController();
$head        = new PoussinController();
$transport   = new TransportController();
$vente       = new VenteController();
$perte      = new PerteController();
$pdf        = new GeneratePdfController();
$campagne_id = 0;
$priceU=null;
$id = $cam->getCampagneenCours();//retourne ttes  les campagnes en cours

for ($i = 0; $i < $id->count(); $i++) {
	//dump($id[$i]->id);
	$result[] = $id[$i]->intitule;
}
//$var= $id->toJson();

$resulat_vente=$vente->calculRecapvente($campagne);
$resultat_pertes=$perte->pertesOfthisCampagne($campagne);
//dump($resultat_pertes);

$resultcampagne = $cam->getInfosOneCampagneEnCours($campagne);//retoutrne infos de la campgne en question

//dd($resultcampagne);

// dd($resulat_vente);

$campagne_id = $cam->getIntituleCampagneenCours(Str::lower($campagne));

$resultsacces = $acess->selectAllAccessoireforthisCampagne($campagne_id);

$totalacces = $acess->calculateDepenseAccessoireofthiscampagne($campagne_id);

$resultsaliment = $food->selectAllAlimentforthisCampagne($campagne_id);

$totalfood = $food->calculateDepenseAlimentofthiscampagne($campagne_id);

$qtyhead = $head->selectheadForOneCampagne($campagne_id);

$totalfrais = $transport->calculateFraisTotalOfCampagne($campagne_id);
//dd($totalfrais);
// $totalfood=$food->calculateDepenseAlimentofthiscampagne($campagne_id);

// dump($results);
$resutpoussins=$head->getQte_Priceof_AchatsPoussins_ForThisCampagne($campagne_id);
if ($resutpoussins) {
	foreach ($resutpoussins as $key => $value) {
  $priceU=$value->priceUnitaire;
   }

}else{
	
}

//dd($resutpoussins->ToArray());

?>
{{--dump($resutpoussins->priceUnitaire)--}}
{{--dump($totalacces)--}}
{{--dump($qtyhead)--}}
{{--dump($totalfrais)--}}
{{--dump($totalfood)--}}

@extends('base')
@section('title')
<title>Bilan-Campagne-Encours</title>
@stop
@section('content')

@extends('layout.partials.template_bilanencours')

@stop
