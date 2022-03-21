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
        $bilans=Bilan::all()->sortByDesc('id');

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
     //   dd( $bilans);
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
        $this->validate($request, $rules);
      //  dd('store');
        $bilans->update([
            // 'title'=>$request->intitule,
             // 'start'=>$tarted,
            //  'status'=>$request->status,
            'obs'=>$request->obs
         ]
        );

       return redirect()->route('bilans.show', $id);

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

    public function bilan_achats_campagne_en_cours()
    {

        try {
            $campagnes=Campagne::orderBy('id', 'desc')->get('intitule');
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($campagnes) {
            // dd($campagnes);
            return view('bilans.bilan_achats_encours', compact('campagnes'));
        }





    }

    public function getBilan_achats_campagne_en_cours(Request $request)
    {
         //dd($request->request);
        $apports=$apportVente=$apportpersonel=0;
        $notification=$cout_de_revientPoussin=null;
        $vente_impaye=array('Encaisse'=>null,'Credit'=>null,'Regler'=>null);
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
        if (isset($campagneInfos[0]['id'])) {

             $resultbilan=$qtyhead=$priceU=0;
             $infosPoussins=Campagne::find($campagneInfos[0]['id'])->poussins;

              $resulat_vente=$vente->calculRecapvente($campagne);
            //   dd($resulat_vente);

             $resultat_vente_impaye=$vente->ventes_impayes($campagneInfos[0]['id']);
            //  dd( $resultat_vente_impaye);
             $resultat_vente_payes=$vente->ventes_regler($campagneInfos[0]['id']);
            // die;
            //  dd($resultat_vente_payes);
            $regler=null;
            if ($resultat_vente_payes->isNotEmpty()) {
                // dd($resultat_vente_payes[0]);

                foreach ($resultat_vente_payes as $key => $solder) {
                    $regler+=($solder['quantite']*$solder['priceUnitaire']);
                }
                // dd($regler);
            }
            if (isset($resultat_vente_impaye['venteimpayes'])) {
                 // dd($resultat_vente_impaye['venteimpayes']);
                 $avance=$reste=0;
                foreach ($resultat_vente_impaye['venteimpayes'] as $key => $venteimpaye) {
                     $avance+=$venteimpaye['avance'];
                     $reste+=$venteimpaye['impaye'];
                }
                $vente_impaye=array('Encaisse'=>$avance,'Credit'=>$reste,'Regler'=>($regler+$avance));
            }


            //dd( $vente_impaye);

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

            // var_dump($apports);
            //die;
            if (!empty($apports)) {
                // dd('Apports');
                foreach ($apports as $key => $value) {
                    //  dd($value);
                    if ($value['origine_apport']=='Apport issu des Ventes') {
                         // dd('ventes');
                          $apportVente+=$value['apport'];
                    } else {
                          $apportpersonel+=$value['apport'];
                    }
                }
            }

             //dd( $apportVente,$apportpersonel);
            // die;
            if ($resultat_pertes['T_qte']==null) {
                 // dd('yes');
                 $resultat_pertes['T_qte']=0;
            }

            if ($resulat_vente['T_qte']==null) {
                   $resulat_vente['T_qte']=0;
                  $resulat_vente['T_vente']=0;
            }

            //calcul coutbde revient
            $totalachat= $totalfrais + $totalfood+$totalacces+($qtyhead*$priceU);
            // dump($totalachat);
            // dd($qtyhead-$resultat_pertes['T_qte']);
            $cout_de_revientPoussin=round( ($totalachat/($qtyhead - $resultat_pertes['T_qte'] )), 2);
            //  $cout_de_revientPoussin;
            $resultbilan= array('resultat_pertes'=>$resultat_pertes,'resulat_vente'=>$resulat_vente,'totalacces'=>$totalacces,
              'totalfood'=>$totalfood,'totalfrais'=>$totalfrais,'qtePoussins'=>$qtyhead,'PousPUAchat'=>$priceU,'Cout_Revient'=>$cout_de_revientPoussin);
             //dd($resultbilan);

            $resultCamp=array('Infos'=>$resultbilan,'Apport'=>array('ApVente'=>$apportVente,'ApPerso'=>$apportpersonel),
                'InfosCampagne'=>$campagneInfos);

            $request->session()->put('detail', $resultCamp);
             // $data = $request->session()->all();

            //dd($bilan->getDetailleAttribute());
             //dd($apportVente,$apportpersonel,'View');
            return view('bilans.getDetailAchatsBilan', compact(
                ['campagne', 'apportVente', 'apportpersonel',
                 'campagneInfos', 'resultbilan', 'notification', 'vente_impaye' ])
            );

        }

        //  dd($apportVente,$apportpersonel);

          $notification=" La ".$campagne." est introuvable.";
         // dd($campagne,$notification);
         return view('bilans.getDetailAchatsBilan', compact(['campagne','notification','campagneInfos']));

    }


    public function infosBilanDetaille($resultbilan,$apportVente,$apportpersonel,$campagneInfos)
    {
        $resultCamp=array('Infos'=>$resultbilan, 'Apport'=>array('ApVente'=>$apportVente, 'ApPerso'=>$apportpersonel),'InfosCampagne'=>$campagneInfos);
        return $resultCamp;
    }


    public function getBilan_detaille()
    {
         return view('bilans.bilanCompletCampagne');

    }

    public function downloadBilan_detaille(Request $request)
    {


        $pdf=new GeneratePdfController();
        $results=$pdf->downloadRecapDetailCampagne(Str::lower($request->campagne));


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


   /**
    * get soft bilanof this campagne
    */

    public function getSoftbilanOfTheCampgne($id)
    {
        $bilans=Bilan::findOrFail($id);
       //  dd($bilans->getAttributes());
        return  $bilans->getAttributes();
    }

}
