<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use PDF;
use App\Campagne;
use App\Model\Poussin;
use App\Model\Perte;
use App\Model\Vente;
use App\Model\Accessoire;
use App\Model\Aliment;
use App\Model\Transport;
use Illuminate\Support\Str;
use App\Model\Bilan;

class GeneratePdfController extends Controller
{
    public function pdfForm()
    {
        return view('pdf.pdf_form');
    }



    public function pdfDownload(Request $request)
    {
       dd('pdf');
       $request->validate([
        'name' => 'required',
       // 'email' => 'required|email',
      //  'message' => 'required'
        ]);
     // dd($request);
         $data = 
         [
            'name' => $request->campagne,
          //  'email' => $request->email,
          //  'message' => $request->message
         ];

         //dd($data);
       $pdf = PDF::loadView('pdf.pdf_download', $data);
       //dump(uniqid());
      // dd(date('d/m/Y'));
       $reference=date('d/m/Y')."-"."bilanPartiel"."-".uniqid();
   
       return $pdf->download($reference.'.pdf');
    }
/**
 * pdf des achats, ventes , pertes et recettes
 *  
 */

    public function pdfDownloadBilan($data){
      $cam= new Campagne();
    $status="";
    $idCampagne=$apportVente=$apportPersonnel=$apports=$budget=null;
    $date=$moyPuVente=$reste=null;
    $quantity=$AchatsAliments=$fraisTransport=$T_Depenses=null;
    $pU=$T_Achats=$T_qtPoussins=$loss=$T_Vente=$qteVendu=$AchatsAccessoires=null;
    $campagnes=Campagne::whereIntitule(['intitule'=>$data])->get();
    if($campagnes->isNotEmpty())
    {
        foreach ($campagnes as $key => $campagne) {
             //dd($campagne);
            $status=$campagne->status;
             $date=$campagne->start;
             $idCampagne=$campagne->id;
             $budget=$campagne->budget;
        }

        $apports=$cam->getApport($idCampagne);
        if (!empty($apports)){
          foreach ($apports as $key => $value) {
     //dump($value['obs']);
           if ($value['obs']=='Apport issu des Ventes') {
             $apportVente+=$value['apport'];
           }else{
            $apportPersonnel+=$value['apport'];
          }

        }


        }
    
    }
    
 //   dd($idCampagne);
    $poussins=Poussin::whereCampagne(['campagne'=>$data])->get(['quantite','priceUnitaire']);
    if ($poussins) {
       foreach ($poussins as $key => $poussin) {
             //dd($campagne);
            $quantity=$poussin->quantite;
             $pU=$poussin->priceUnitaire;
             $T_qtPoussins=$quantity*$pU;
        }
    }
     

    $pertes=Perte::whereCampagne(['campagne'=>$data])->get('quantite');
    if ($pertes) {
        foreach ($pertes as $key => $perte) {
             //dd($campagne);
            $loss+=$perte->quantite;
            
        }
    }
   // dd( $loss);
     $ventes=Vente::whereCampagne(['campagne'=>$data])->get(['quantite','priceUnitaire']);

     if ($ventes) {
         foreach ($ventes as $key => $vente) {
            // dd( $vente);
            $qteVendu+=$vente->quantite;
            $T_Vente+=$vente->quantite*$vente->priceUnitaire;
        }
     }
    // dump($qteVendu);
    // dd($T_Vente);

      $accessoires=Accessoire::whereCampagne(['campagne'=>$data])->get(['quantite','priceUnitaire']);

     if ($accessoires) {
         foreach ( $accessoires as $key => $accessoire) {
            $AchatsAccessoires+=$accessoire->quantite*$accessoire->priceUnitaire;
        }
     }


     $aliments=Aliment::whereCampagne(['campagne'=>$data])->get(['quantite','priceUnitaire']);

     if ($aliments) {
         foreach ($aliments as $key => $aliment) {
            $AchatsAliments+=$aliment->quantite*$aliment->priceUnitaire;
        }
     }

     $frais=Transport::whereCampagne(['campagne'=>$data])->get('montant');

     if ($frais) {
         foreach ($frais as $key => $transport) {
            $fraisTransport+=$transport->montant;
        }
     }
    

    $T_Depenses=($AchatsAccessoires+$AchatsAliments+$fraisTransport+$T_qtPoussins);
   
   
   if ($quantity==$qteVendu ) {
    $reste="Tous vendus";
    $moyPuVente=($T_Vente/$qteVendu);
   }elseif ($qteVendu==null) {
      $reste="Aucune Vente à ce jour"; 
      $moyPuVente=0.0;
   }else{
    $reste=($quantity-($qteVendu+$loss));
    $moyPuVente=($T_Vente/$qteVendu);
   }



    // $date=$data['debut'];
     $data2 =  [
            'date' =>$date,
            'campagne'=>$data,
            'Budget'=>$budget,
            'status'=>$status,
            'QuantitePoussins'=>$quantity,
            'PUAchatPoussins'=>$pU,
            'T_achatsPoussins'=>$T_qtPoussins,
            'QteLoss'=>$loss,
            'QteVendu'=>$qteVendu,
            'T_vente'=>$T_Vente,
            'T_Accessoires'=>$AchatsAccessoires,
            'T_Aliments'=>$AchatsAliments,
            'T_Transport'=>$fraisTransport,
            'T_DepnsesAchats'=>$T_Depenses,
            'MoyenPU_vente'=>round($moyPuVente,2),
            'Qte_Restante'=>$reste,
            'ApportVente'=>$apportVente,
            'ApportPersonnel'=>$apportPersonnel,
            'Solde'=>($T_Vente - $apportVente)
         ];

     $pdf = PDF::loadView('pdf.pdf_bilanPartiel',$data2);
     //dd($data);

     $reference=date('d/m/Y')."-"."bilanPartiel"."-".uniqid();
     return $pdf->download($reference.'.pdf');

    }


/**
* generation du pdf du detail des ventes d'une vcampagne
*/
    
 public function downloadRecapVente($data)
 {
    $campagne=$data;
    //$totalVente=$totalqte=$total=null;

   // $arrayVente=[];
   $ventes= new VenteController();
   $results= $ventes->downloadRecapVente($data);
   // dump($results);

    $arrayVente=$this->getData($results);
  // dd($arrayVente);

   /*foreach ($results as $key => $vente ){
    //   dump($vente);
       $totalqte+=$vente->quantite;
       $total=($vente->quantite*$vente->priceUnitaire); 
       $totalVente+=$total;
       $data2 = [
            'date' =>$vente->obs,
            'campagne'=>$data,  
            'Quantite'=>$vente->quantite,
            'PUA'=>$vente->priceUnitaire,       
            'T_vente'=>$total
         ];

      $arrayVente[]= $data2;

   }*/

 //dump($totalVente);
 //dd($totalqte);

    

     $pdf = PDF::loadView('pdf.pdf_vente',['vente'=>$arrayVente,'campagne'=>$campagne]);
     //dd($data);

     $reference=date('d/m/Y')."-"."bilanVente"."-".$data."-".uniqid();
     return $pdf->download($reference.'.pdf');

  
    
 }

/**
* generation du pdf du detal des accessoires d'une campagne
* 
*/
    
 public function downloadRecapAccessoires($data)
 {
    $campagne=$data;
    //$totalAccessoire=$totalqte=$total=null;

    //$arrayAccessoire=[];

    $accessoires= new AccessoireController();
   $results= $accessoires->downloadRecapAccessoires($data);

   $arrayAccessoire=$this->getData($results);
  // dd($arrayAccessoire);



   /*foreach ($results as $key => $accessoire ){
    //   dump($vente);
      // $totalqte+=$accessoire->quantite;
       $total=($accessoire->quantite*$accessoire->priceUnitaire); 
       $totalAccessoire+=$total;
       $data2 = [
            'date' =>$accessoire->date_achat,
            'campagne'=>$data,  
            'Quantite'=>$accessoire->quantite,
            'PUA'=>$accessoire->priceUnitaire,       
            'T_Accessoire'=>$total,
            'obs'=>$accessoire->obs,
            'libelle'=>$accessoire->libelle
         ];

      $arrayAccessoire[]= $data2;

   }*/
   //$arraytest=$this->getData($results);
   //   dd($arraytest);
  

 //   dd($results);
     $pdf = PDF::loadView('pdf.pdf_accessoire',['accessoire'=>$arrayAccessoire,'campagne'=>$campagne]);
     //dd($data);

     $reference=date('d/m/Y')."-"."RecapAccessoire"."-".$data."-".uniqid();
     return $pdf->download($reference.'.pdf');
    
    
 }

/**
* generation pdf des aliments d'une campagne
* 
*/
    
 public function downloadRecapAliments($data)
 {
   //dd('here');
     
     $campagne=$data;
    // $totalAliment=$totalqte=$total=null;

   // $arrayAliment=[];
    $aliments= new AlimentController();
   $results= $aliments->downloadRecapAliments($data);

   $arrayAliment=$this->getData($results);
  // dd($arrayAliment);


    /*foreach ($results as $key => $aliment ){
    //   dump($vente);
      // $totalqte+=$accessoire->quantite;
       $total=($aliment->quantite*$aliment->priceUnitaire); 
       $totalAliment+=$total;
       $data2 = [
            'date' =>$aliment->date_achat,
            'campagne'=>$data,  
            'Quantite'=>$aliment->quantite,
            'PUA'=>$aliment->priceUnitaire,  
            'libelle'=>$aliment->libelle,     
            'T_Aliment'=>$total,
            'obs'=>$aliment->obs
         ];

      $arrayAliment[]= $data2;

     }*/

     //$arraytest=$this->getData($results);
      //dd($arraytest);
  
  
 //dump($totalAliment);
 //   dd($arrayAliment);

    $pdf = PDF::loadView('pdf.pdf_aliment',['aliment'=>$arrayAliment,'campagne'=>$campagne]);
     //dd($data);

     $reference=date('d/m/Y')."-"."RecapAliment"."-".$data."-".uniqid();
     return $pdf->download($reference.'.pdf');  
    
 }

 /**
* generation pdf detailler de la campagne 
* 
*/
    
 public function downloadRecapDetailCampagne($data)
 {
  $cam= new Campagne();
  $bilan = new Bilan();
  $apportVente=null;
  $apportPersonnel=null;
  $arrayCampagne=[];
  $results = array('Campagne'=>null,'Apports'=>null,'Poussin' =>null,'Perte'=>null,'Frais'=>null,'Aliment'=>null,'Accessoire'=>null,'Vente'=>null );
  $campagne=$bilan->getInfosCampagne(Str::lower($data));
  //dump($campagne[0]['id']);
  if($campagne->isNotEmpty())
  {
   $results = array('Campagne'=>array('Budget' => $campagne[0]['budget'],'Obs'=>$campagne[0]['obs']),'Poussin' =>null,'Perte'=>null,'Frais'=>null,'Aliment'=>null,'Accessoire'=>null,'Vente'=>null );  

   $apports=$cam->getApport($campagne[0]['id']);
   //dd($apports);
   if (!empty($apports)) {
    foreach ($apports as $key => $value) {
     //dump($value['obs']);
     if ($value['obs']=='Apport issu des Ventes') {
       $apportVente+=$value['apport'];

      $results = array('Campagne'=>array('Budget' => $campagne[0]['budget'],'Obs'=>$campagne[0]['obs']),'Apports'=>array('AppVente'=>$apportVente,'AppPerso'=>null),'Poussin' =>null,'Perte'=>null,'Frais'=>null,'Aliment'=>null,'Accessoire'=>null,'Vente'=>null );
     }else{
      $apportPersonnel+=$value['apport'];

      $results = array('Campagne'=>array('Budget' => $campagne[0]['budget'],'Obs'=>$campagne[0]['obs']),'Apports'=>array('AppVente'=>$apportVente,'AppPerso'=>$apportPersonnel),'Poussin' =>null,'Perte'=>null,'Frais'=>null,'Aliment'=>null,'Accessoire'=>null,'Vente'=>null );
     }
    
   }
     
   }

  }

//dd($cam->getApport($campagne[0]['id']));

  
   $poussin= new PoussinController();
   $results= $poussin->downloadRecapPoussin($data);
  
   $arrayPoussin=$this->getData($results);
   $arrayCampagne[]=$arrayPoussin;

   if (!empty($arrayPoussin)) {
       $results = array('Campagne'=>array('Budget' => $campagne[0]['budget'],'Obs'=>$campagne[0]['obs']),'Apports'=>array('AppVente'=>$apportVente,'AppPerso'=>$apportPersonnel),'Poussin' =>$arrayPoussin,'Perte'=>null,'Frais'=>null,'Aliment'=>null,'Accessoire'=>null,'Vente'=>null );
     } else {
       
     }

    $perte= new PerteController();
   $results=$perte->downloadRecapPerte($data);
   
   $arrayPerte=$this->getData($results);
   $arrayCampagne[]=$arrayPerte;

   if (!empty($arrayPerte)) {
     $results = array('Campagne'=>array('Budget' => $campagne[0]['budget'],'Obs'=>$campagne[0]['obs']),'Apports'=>array('AppVente'=>$apportVente,'AppPerso'=>$apportPersonnel),'Poussin' =>$arrayPoussin,'Perte'=>$arrayPerte,'Frais'=>null,'Aliment'=>null,'Accessoire'=>null,'Vente'=>null );
   } else {
     # code...
   }
   

   $frais= new TransportController();
   $results=$frais->downloadRecapFrais($data);
   
   $arrayFrais=$this->getData($results);
   $arrayCampagne[]=$arrayFrais;
   if (!empty($arrayFrais)) {
     $results = array('Campagne'=>array('Budget' => $campagne[0]['budget'],'Obs'=>$campagne[0]['obs']),'Apports'=>array('AppVente'=>$apportVente,'AppPerso'=>$apportPersonnel),'Poussin' =>$arrayPoussin,'Perte'=>$arrayPerte,'Frais'=>$arrayFrais,'Aliment'=>null,'Accessoire'=>null,'Vente'=>null );
   }

   $aliments= new AlimentController();
   $results= $aliments->downloadRecapAliments($data);

   $arrayAliment=$this->getData($results);
   $arrayCampagne[]=$arrayAliment;
   if (!empty($arrayAliment)) {
     $results = array('Campagne'=>array('Budget' => $campagne[0]['budget'],'Obs'=>$campagne[0]['obs']),'Apports'=>array('AppVente'=>$apportVente,'AppPerso'=>$apportPersonnel),'Poussin' =>$arrayPoussin,'Perte'=>$arrayPerte,'Frais'=>$arrayFrais,'Aliment'=>$arrayAliment,'Accessoire'=>null,'Vente'=>null );
   }

    $accessoires= new AccessoireController();
   $results= $accessoires->downloadRecapAccessoires($data);

   $arrayAccessoire=$this->getData($results);
   $arrayCampagne[]=$arrayAccessoire;

   if (!empty($arrayAccessoire)) {
      $results = array('Campagne'=>array('Budget' => $campagne[0]['budget'],'Obs'=>$campagne[0]['obs']),'Apports'=>array('AppVente'=>$apportVente,'AppPerso'=>$apportPersonnel),'Poussin' =>$arrayPoussin,'Perte'=>$arrayPerte,'Frais'=>$arrayFrais,'Aliment'=>$arrayAliment,'Accessoire'=>$arrayAccessoire,'Vente'=>null );
   }

   $ventes= new VenteController();
   $results= $ventes->downloadRecapVente($data);
    //dd($results);
    $arrayVente=$this->getData($results);
    $arrayCampagne[]=$arrayVente;

     if (!empty($arrayVente)) {
       $results = array('Campagne'=>array('Budget' => $campagne[0]['budget'],'Obs'=>$campagne[0]['obs']),'Apports'=>array('AppVente'=>$apportVente,'AppPerso'=>$apportPersonnel),'Poussin' =>$arrayPoussin,'Perte'=>$arrayPerte,'Frais'=>$arrayFrais,'Aliment'=>$arrayAliment,'Accessoire'=>$arrayAccessoire,'Vente'=>$arrayVente );
     }

    
    //dd($results);
   return $results;
  
 }


/**
* function genere les datas a manipuler  data pour la vue pdf pour aliment , accesoires
* return array
*/
    
 public function getData($results)
 {
  
   $arrayData=[];
   $total=$Total=$data=$qteT=null;
   $arrayInfo=array('Data'=>$arrayData,'Total'=>$Total,'qteT'=>$qteT);
   //dd($results);


  foreach ($results as $key => $result ){

    if ( get_class($result)=="App\Model\Poussin") {
    //  dd($result);
       $total=($result->quantite*$result->priceUnitaire); 
       //$Total+=$total;
       $data =[
            'date' =>$result->date_achat,
            'campagne'=>$result->campagne,  
            'Quantite'=>$result->quantite,
            'PUA'=>$result->priceUnitaire,  
            'Fournisseur'=>$result->fournisseur,     
            'T_achat'=>$total,
            'obs'=>$result->obs
         ];


    }elseif (get_class($result)=="App\Model\Vente") {
      //dd($result);
       $total=($result->quantite*$result->priceUnitaire); 
       $Total+=$total;
       $qteT+=$result->quantite;
       $data =[
            'date' =>$result->date,
            'campagne'=>$result->campagne,  
            'Quantite'=>$result->quantite,
            'PUA'=>$result->priceUnitaire,      
            'T_vente'=>$total
           
         ];


    }elseif (get_class($result)=="App\Model\Aliment" || get_class($result)=="App\Model\Accessoire") {
     // dd('Aliment /Accessoire');    
      $total=($result->quantite*$result->priceUnitaire); 
       $Total+=$total;
       $data =[
            'date' =>$result->date_achat,
            'campagne'=>$result->campagne,  
            'Quantite'=>$result->quantite,
            'PUA'=>$result->priceUnitaire,  
            'libelle'=>$result->libelle,     
            'T_achat'=>$total,
            'obs'=>$result->obs
         ];

    }elseif (get_class($result)=="App\Model\Perte") {
      //dd($result);
      $Total+=$result->quantite;
       $data =[
            'date' =>$result->date_die,
            'campagne'=>$result->campagne,  
            'cause'=>$result->cause,
            'quantite'=>$result->quantite,      
            'living'=>$result->duredevie,
            'obs'=>$result->obs
           
         ];


    }elseif (get_class($result)=="App\Model\Transport") {
     $Total+=$result->montant;
      $data =[
            'date' =>$result->date_achat,
            'campagne'=>$result->campagne,  
            'montant'=>$result->montant,
                 
            'obs'=>$result->obs
           
         ];
    }
   
    //   dump($vente);
      // $totalqte+=$accessoire->quantite;
       

      $arrayData[]= $data;

   }

   $arrayInfo=array('Data'=>$arrayData,'Total'=>$Total,'qteT'=>$qteT);
   //dd($arrayInfo);
 
   return $arrayInfo;

 }


/**
* generation pdf pour poussin et pertes 
* 
*/

  public function downloadRecapPoussin($data)
 {
    $poussin= new PoussinController();
   $results= $poussin->downloadRecapPoussin($data);
   
   $arrayPoussin=$this->getData($results);
   // dd($arrayPoussin['Data']);

    $pdf = PDF::loadView('pdf.pdf_poussins',['poussin'=> $arrayPoussin,'campagne'=>$data]);
     //dd($data);

     $reference=date('d/m/Y')."-"."RecapPoussin"."-".$data."-".uniqid();
     return $pdf->download($reference.'.pdf');  
    
 }
 

/**
* generation pdf  pertes 
* 
*/

  public function downloadRecapPerte($data)
 {
    $perte= new PerteController();
   $results=$perte->downloadRecapPerte($data);
   
   $arrayPerte=$this->getData($results);
  //  dd($arrayPerte);

    $pdf = PDF::loadView('pdf.pdf_perte',['perte'=> $arrayPerte,'campagne'=>$data]);
     //dd($data);

     $reference=date('d/m/Y')."-"."RecapPerte"."-".$data."-".uniqid();
     return $pdf->download($reference.'.pdf');  
  
 }

 /**
* generation pdf  frais de transport for one campagne
* 
*/

  public function downloadRecapFrais($data)
 {
    $frais= new TransportController();
   $results=$frais->downloadRecapFrais($data);
   
   $arrayFrais=$this->getData($results);
    //dd($arrayFrais);

    $pdf = PDF::loadView('pdf.pdf_transport',['transport'=> $arrayFrais,'campagne'=>$data]);
     //dd($data);

     $reference=date('d/m/Y')."-"."RecapTransport"."-".$data."-".uniqid();
     return $pdf->download($reference.'.pdf');  
  
 }

/**
 * gener pdf depuis la vue vaccin
 */
 public function downloadSuiviVaccins($data)
 { 
    //dump('pdf');
   //  dd($data);
     if (!empty($data)) {
        return $data; 
     }
     return back()->with('success','Aucun suivi trouvé pour cette campagne');
     
 }




}
