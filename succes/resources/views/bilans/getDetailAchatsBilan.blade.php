<?php
use App\Campagne;
use App\Http\Controllers\CampagneController;

use App\Http\Controllers\GeneratePdfController;
use Illuminate\Support\Str;

$campagne = $_POST['campagne'];
//dd($campagne ,$notification);
//$resultcampagne = array('id'=>'','intitule'=>'','status'=>'','date-creation'=>'');
//echo "string";
$camp= new Campagne();
$cam  = new CampagneController();


$pdf = new GeneratePdfController();
$campagne_id = 0;
//$priceU=null;
//dd($campagne);
//$infos=$cam->getInfosCampagne($campagne);
//dd($infos[0]['id']);
/*$id = $cam->getCampagneenCours();//retourne ttes  les campagnes en cours

for ($i = 0; $i < $id->count(); $i++) {
	//dump($id[$i]->id);
	$result[] = $id[$i]->intitule;
}*/
//$var= $id->toJson();


//dump($resultat_pertes);

//$resultcampagne = $cam->getInfosOneCampagneEnCours($campagne);//retoutrne infos de la campgne en question
//dump($resulat_vente);
//dd($resultcampagne);

//$campagne_id = $cam->getIntituleCampagneenCours(Str::lower($campagne));

//dd($totalfrais);
//

// dump($results);
/*$resutpoussins=$head->getQte_Priceof_AchatsPoussins_ForThisCampagne($campagne_id);
if ($resutpoussins) {
	foreach ($resutpoussins as $key => $value) {
  $priceU=$value->priceUnitaire;
   }

}else{
	
}
;*/

//dd($resutpoussins->ToArray());
//dd($campagneInfos->count()>0);

//dd($campagne,$resultbilan,$apportVente,$apportpersonel);

/*if ($campagneInfos->count()>0) {
	dd($campagneInfos);
}*/


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
