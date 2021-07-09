<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Bilan;
class StatistiqueController extends Controller
{
    
  /**
   * calcul stat of each campagne
   * 
   */
   public function statCampagne()
   {
    //step get infos vente and pertes campagnes en cours
     
    $vente= new VenteController();
    $resultsVente=$vente->ventes_campagne_en_cours();  
    //dd($resultsVente);
     
    $perte= new PerteController();
    $resultsPertes=$perte->pertes_campagne_en_cours();
  //dd( $resultsPertes);
    //step Bilan 

    $bilan= new Bilan();
  //  dd($bilan);
    $result=$bilan->getBudgetBenefice();
    
  // dd($result);
   $arraycampagne=[];
   $arraybudget=[];
   $arrayventes=[];
   $arrayachats=[];
   $arraybenefice=[];
   $arrayqteperdus=[];
   $arrayqteachetes=[];
    if (!empty($result)) {
        foreach ($result as $key => $campagne) {
            $arraycampagne[]=$campagne->campagne;
            $arraybudget[]=$campagne->budget;
            $arrayachats[]=$campagne->totalAchats;
            $arrayventes[]=$campagne->totalVentes;
            $arrayqteachetes[]=$campagne->quantite_achetes;
            $arrayqteperdus[]=$campagne->quantite_perdus;
           $arraybenefice[]=$campagne->benefice;

        }
    }


     
   /* dd($arraycampagne,$arraybudget,
    $arrayachats,$arrayventes,$arrayqteachetes,
    $arrayqteperdus,$arraybenefice);
    */
    $result= array('campagne'=>json_encode($arraycampagne),'budget'=>json_encode($arraybudget),
     'achats'=>json_encode($arrayachats),'ventes'=>json_encode($arrayventes)
    ,'poussins'=>json_encode($arrayqteachetes),'pertes'=>json_encode($arrayqteperdus),
    'benefice'=>json_encode($arraybenefice),'pertes_encours'=>json_encode($resultsPertes['qte']),
    'campagne_enCours'=>json_encode($resultsPertes['campagne']),
    'DateDie_enCours'=>json_encode($resultsPertes['dateDie']),
    'Vente_enCoursQte'=>json_encode($resultsVente['qte']) ,
    'Vente_enCoursDate'=>json_encode($resultsVente['dateVente']) 
  );

 // dd($result);
    
    return view('stats.index',compact('result'));
     
   }



}
