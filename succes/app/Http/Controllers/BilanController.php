<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Bilan;
use App\Campagne;
use App\Http\Controllers\GeneratePdfController;
use Illuminate\Support\Str;
use PDF;
use App\Http\Controllers\AccessoireController;
use App\Http\Controllers\AlimentController;
use App\Http\Controllers\PoussinController;
class BilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bilans=Bilan::all();

        return view('bilans.index',compact('bilans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bilans=Bilan::findOrFail($id);
         return view('bilans.show', compact('bilans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bilans=Bilan::findOrFail($id);
        return view('bilans.edit',compact('bilans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $bilans=Bilan::findOrFail($id);
        $rules=[
            'obs'=>'required|min:3'
           // 'start'=>'bail|required',
           // 'status'=>'required|min:7'
        ];
        $this->validate($request,$rules);
      //  dd('store');
        $bilans->update([
           // 'title'=>$request->intitule,
           // 'start'=>$tarted,
          //  'status'=>$request->status,
            'obs'=>$request->obs
        ]);

       return redirect()->route('bilans.show',$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bilan_achats_campagne_en_cours(){

   
       return view('bilans.bilan_achats_encours');
    
  }
/**
 * 
 */
   public function getBilan_achats_campagne_en_cours(Request $request){
    // dd($request->request);
     $apports=$apportVente=$apportpersonel=0;
    $notification=null;
   $bilan= new Bilan();
   $cam= new Campagne();
   $acess= new AccessoireController();
   $food  = new AlimentController();
   $head = new PoussinController();
   $transport   = new TransportController();
   $vente  = new VenteController();
   $perte  = new PerteController();
   $campagneInfos= $bilan->getInfosCampagne(Str::lower($request->campagne));
  // dd($campagneInfos);
   $campagne=$request->campagne;
  //  dd($campagneInfos,$campagneInfos[0]['budget']);
  // dd($campagneInfos->isNotEmpty());
   if ($campagneInfos->isNotEmpty()) {
  
    $resultbilan=$qtyhead=$priceU=0;
    $infosPoussins=Campagne::find($campagneInfos[0]['id'])->poussins;
   
    $resulat_vente=$vente->calculRecapvente($campagne);
    $resultat_pertes=$perte->pertesOfthisCampagne($campagne);

    $resultsacces = $acess->selectAllAccessoireforthisCampagne($campagneInfos[0]['id']);
    $totalacces = $acess->calculateDepenseAccessoireofthiscampagne($campagneInfos[0]['id']);

    $resultsaliment = $food->selectAllAlimentforthisCampagne($campagneInfos[0]['id']);
    $totalfood=$food->calculateDepenseAlimentofthiscampagne($campagneInfos[0]['id']);

    $totalfrais = $transport->calculateFraisTotalOfCampagne($campagneInfos[0]['id']);
   // $qtyhead = $head->selectheadForOneCampagne($campagneInfos[0]['id']);

      $totalfood = $food->calculateDepenseAlimentofthiscampagne($campagneInfos[0]['id']);
      $budget=$campagneInfos[0]['budget'];
      $campagne_id=$campagneInfos[0]['id'];
      $apports=$cam->getApport($campagne_id);//recu  apport of campagne
     
      if ($infosPoussins->isNotEmpty()) {
        $qtyhead=$infosPoussins[0]['quantite'];
        $priceU=$infosPoussins[0]['priceUnitaire'];

      }
     // dd($qtyhead,$priceU,$resulat_vente,$resultat_pertes,$totalfood,$campagneInfos);

     // dd($apports);
      if(!empty($apports)){
       // dd('Apports');
        foreach ($apports as $key => $value) {
         //dump($value['obs']);
         if ($value['obs']=='Apport issu des Ventes') {
            $apportVente+=$value['apport'];
          }else{
            $apportpersonel+=$value['apport'];
          }
        }
      }
      if ($resultat_pertes['T_qte']==null) {
       // dd('yes');
        $resultat_pertes['T_qte']=0;
      }

      if ($resulat_vente['T_qte']==null) {
        $resulat_vente['T_qte']=0;
        $resulat_vente['T_vente']=0;
      }

      $resultbilan= array('resultat_pertes'=>$resultat_pertes,'resulat_vente'=>$resulat_vente,'totalacces'=>$totalacces,
    'totalfood'=>$totalfood,'totalfrais'=>$totalfrais,'qtePoussins'=>$qtyhead,'PousPUAchat'=>$priceU);
   //dd($resultbilan);
   $resultCamp=array('Infos'=>$resultbilan,'Apport'=>array('ApVente'=>$apportVente,'ApPerso'=>$apportpersonel),
    'InfosCampagne'=>$campagneInfos);
    
    $request->session()->put('detail',$resultCamp);
   // $data = $request->session()->all();
    
    //dd($bilan->getDetailleAttribute());
        //dd($apportVente,$apportpersonel,'View');
        return view('bilans.getDetailAchatsBilan',compact(['campagne','apportVente','apportpersonel',
        'campagneInfos','resultbilan','notification']));
      
    }
  
 //  dd($apportVente,$apportpersonel);       
     
      $notification=" La ".$campagne." est introuvable.";
     // dd($campagne,$notification);
       return view('bilans.getDetailAchatsBilan',compact(['campagne','notification','campagneInfos']));
    
  }
  /**
   * return result to pdf download
   */
  public function infosBilanDetaille($resultbilan,$apportVente,$apportpersonel,$campagneInfos)
  {
   $resultCamp=array('Infos'=>$resultbilan,'Apport'=>array('ApVente'=>$apportVente,'ApPerso'=>$apportpersonel),'InfosCampagne'=>$campagneInfos);
   return $resultCamp;
  }

  /**
   * 
   */
   public function getBilan_detaille()
   {
     return view('bilans.bilanCompletCampagne');

   }
   /**
   * 
   */
   public function downloadBilan_detaille(Request $request)
   {
    // dd($request->campagne);
   
      $pdf=new GeneratePdfController();
     $results=$pdf->downloadRecapDetailCampagne(Str::lower($request->campagne));

  // dd($results);
    // dd($results['Poussin']);
    /* foreach ( $results as $key => $value) {
        if ($key=='Poussin' && empty($value)) {
        echo "Campagne terminé";
        return;
        }else{
            if ($key=='Aliment') {
                if (empty($value['Data'])) {
                    echo "Empty";
                }else{
                  for ($i=0; $i <count($value['Data']); $i++) { 
                    if(count($value['Data'])==1){
                        dump($value['Data'][0]);
                    }else{
                       dump($value['Data'][$i]);
                    }
                    
                 }  
                }
                          
            }
         
        }
     }
     dd($results);*/
  //  dd($results);
    //dd($results['Campagne']);
      $pdf = PDF::loadView('bilans.pdf_bilan',['results'=>$results,'campagne'=>Str::lower($request->campagne)]);
     //dd($data);

     $reference=date('d/m/Y')."-"."Recap"."-".Str::lower($request->campagne)."-".uniqid();
     return $pdf->download($reference.'.pdf'); 

   }
    

}
