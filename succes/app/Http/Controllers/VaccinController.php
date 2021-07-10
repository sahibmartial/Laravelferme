<?php

namespace App\Http\Controllers;

use App\Model\Vaccin;
use App\Campagne;
use Illuminate\Http\Request;
use App\Http\Controllers\GeneratePdfController;
use PDF;
class VaccinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaccin= new Vaccin();         
        
      // $vaccin->alertMailingSuivi();
        $resultscampa=$vaccin->infosCampagneStatus("EN COURS");
       //dd($resultscampa);

        if (count($resultscampa)>0) {
            $vaccins= Vaccin::whereCampagneId($resultscampa[0]['id'])
            ->orderByDesc('vaccins.id')
            ->SimplePaginate(10)
             ;
            // dump($vaccins);
            //dd('campagne e cours');
            return view('vaccins.index',compact('vaccins'));
        }
       
        return back()->with('success','Aucun suivi de vaccin en cours actuellement');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vaccins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Vaccin $vaccin,Request $request)
    {  $id=null;
       $suivi= $vaccin->infosCampagneStatus("EN COURS");
     //  dump($suivi);
       $id=$suivi[0]['id'];
     //  dd($id);
         
        $arrayIntervention=[];
        //preparez un array ou je parcours les select et jes ordonne dans une ligne unique pour insertion plus simple 
        
         $select=$request->intitulevaccin;
        //dd($select[0]);
        
        if (count($select)>1) {
            for ($i=0; $i <count($select) ; $i++) { 
                $arrayIntervention[]= array('id_camp'=>$id,'campagne'=>$request->campagne,'date'=>$request->datevaccination,'intitulevaccin'=>$select[$i],'obs'=>$request->obs); 
            } 
          //  dd($arrayIntervention);
        }else{
          //  dd('here');
            $arrayIntervention[]= array('id_camp' =>$id,'campagne'=>$request->campagne,'date'=>$request->datevaccination,'intitulevaccin'=>$select[0],'obs'=>$request->obs); 
           // dd($arrayIntervention);
        }
        //dd($arrayIntervention);
       
        foreach ($arrayIntervention as $key => $suivi) {
         
           try {
            $rules=[
                'campagne'=>'required|min:9',
                 'datevaccination'=>'bail|required',
                'intitulevaccin'=>'bail|required',
                'obs'=>'required|min:3'];
                $this->validate($request,$rules);

               if (count($suivi)>=1) {
               // dump($suivi);
                Vaccin::create([
                 'campagne_id'=>$suivi['id_camp'],
                 'campagne'=>$suivi['campagne'],
                 'datedevaccination'=>$suivi['date'],
                 'intitulevaccin'=>$suivi['intitulevaccin'],
                 'obs'=>$suivi['obs']

                ]);
            
               }else{
                throw new \Throwable("");
               }

           } catch (\Throwable $th) {
           // dd($th->getMessage());
            return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
           }
         
        }
      //  die();
      return redirect()->route('vaccins.index')->with('success', 'Vaccination  enregistré avec sucess');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        try {
            $suivi=Vaccin::findOrFail($id);

            return view('vaccins.show', compact('suivi'));

        } catch (\Throwable $th) {
             throw $th;
        }
       
       // dd( $suivi->id);
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suivi=Vaccin::findOrFail($id);
      //  dd($suivi);
        return view('vaccins.edit',compact('suivi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      // dd($id);
     // dump($request);
        try {
            $suivi=Vaccin::findOrFail($id);
         //   dd($suivi);
            if ($id) {
              
                $rules=[
                    'campagne'=>'required|min:9',
                     'datevaccination'=>'bail|required',
                    'intitulevaccin'=>'bail|required',
                    'obs'=>'required|min:3'];
                    $this->validate($request,$rules);
                   // dd("here IN");
                   $suivi->update([
                    'campagne_id'=>$request->campagne_id,
                    'campagne'=>$request->campagne,
                    'datedevaccination'=>$request->datevaccination,
                    'intitulevaccin'=>$request->intitulevaccin,
                   'obs'=>$request->obs

                ]); 
                      
            
            }else{
                throw new \Throwable("Modification vaccin impossible");
            }
        } catch (\Throwable $th) {
         //   dd($th->getMessage());
            return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
        }

        return redirect()->route('vaccin')->with('success', 'Vaccin modifié avec sucess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder="VaccinRemove/";
        $name=uniqid().'-'.date("Y-m-d H:i:s");
        $filename=$name."."."txt";
        $filebackup= new BackUpFermeController();
        try {
            $value=Vaccin::findorfail($id);
        
            $filebackup->backupfile($folder,$filename,$value);

            Vaccin::destroy($id);
            return redirect()->route('vaccin')->with('success', 'Vaccin  supprimé avec sucess');
        
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
    /**
     * form to download recap traitement
     */
    public function recapVaccin()
    {
        return view('vaccins.recapVaccin');
    }
    /**
     * listing traitement vaccin pdf generation du fichier pdf
     */
    public function getRecap(Request $request)
    {   
         $pdf= new GeneratePdfController();

        $vaccin= new Vaccin();
        $data=$vaccin->getRecap($request->campagne);
      //  dd();
        if (count($data)>0) {
            $pdf = PDF::loadView('vaccins.pdf_suivivaccin',['campagne'=>$request->campagne,'data'=>$data]);
       
    
            $reference=date('d/m/Y')."-"."RecapTraitement".$request->campagne."-".uniqid();
           // dd( $reference);
            return $pdf->download($reference.'.pdf');  
        }
        return back()->with('success','Impossible de télécharger pdf, aucun suivi trouvé pour cette campagne');
          

    }
   
    /**
     * pdf suivi des traitement
     */

    public function traitement_pdf()
    {    $traitements=[];
        $traitement=array('jour'=>'Jour1','Actions'=>' Pulverisations quotidien tous les 3 jours | Au sucré /Mixtral /BetaSpro-C');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour2','Actions'=>'ANTISTRESS : Supervitassol / Panthéryl / Alfaceril');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour3','Actions'=>'ANTISTRESS : Supervitassol / Panthéryl / Alfaceril');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour4','Actions'=>'ANTISTRESS : Supervitassol / Panthéryl / Imuneo');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour5','Actions'=>'Vaccin : 1er vaccin HB1 |  1er vaccin H120  | SuperVitassol :  Panthéryl / Imuneo');
        $traitements[]=$traitement;

        $traitement=array('jour'=>'Jour6','Actions'=>' Supervitassol / Panthéryl / Imuneo');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour7','Actions'=>' Eau simple');
        $traitements[]=$traitement;

        $traitement=array('jour'=>'Jour8','Actions'=>' Eau simple');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour9','Actions'=>' VITAMINES : AmineTotal / Supervitassol');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour10','Actions'=>' Vaccin: 1er vaccin de GUMBHORO | VITAMINES : AmineTotal / Vitaminolyte Super');
        $traitements[]=$traitement;

        $traitement=array('jour'=>'Jour11','Actions'=>"VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour12','Actions'=>"VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour13','Actions'=>' Eau simple');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour14','Actions'=>' Eau simple');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour15','Actions'=>' Eau simple');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour16','Actions'=>' Eau simple');
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour17','Actions'=>"VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super");
        $traitements[]=$traitement;

        $traitement=array('jour'=>'Jour18','Actions'=>"Vaccin :2ième rappel vaccin  GUMBHORO");
        $traitements[]=$traitement;

        $traitement=array('jour'=>'Jour19','Actions'=>"VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour20','Actions'=>"Eau simple");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour21','Actions'=>"Phase de Transition Alimentaire:3/4 Aliment de démarrage + 1/4 Aliment croissance | Anticoccidiens: Vetacox /Anticox");
        $traitements[]=$traitement;

        $traitement=array('jour'=>'Jour22','Actions'=>"Phase de Transition Alimentaire:1/2 Aliment de démarrage + 1/2 Aliment croissance | Anticoccidiens: Vetacox /Anticox");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour23','Actions'=>"Phase de Transition Alimentaire:1/4 Aliment de démarrage + 3/4 Aliment croissance | Anticoccidiens: Vetacox /Anticox");
        $traitements[]=$traitement;
       
        $traitement=array('jour'=>'Jour24','Actions'=>"Anticoccidiens: Vetacox / Anticox");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour25','Actions'=>"Anticoccidiens: Vetacox / Anticox");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour26','Actions'=>"Vitamines : Amin'Total");
        $traitements[]=$traitement;

        $traitement=array('jour'=>'Jour27','Actions'=>"Vaccin: 2ième rappel vaccin HB1 | 2ième rappel vaccin H120 | Vitamines: Amin'Total");
        $traitements[]=$traitement;

        $traitement=array('jour'=>'Jour28','Actions'=>"Eau simple");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour29','Actions'=>" Vaccin: 3ième rappel vaccin GUMBORHO: HIPRAGUMBORO GM97 / CEVAC IBDL /AVI IBD PLUS / NOBILIS 228E");
        $traitements[]=$traitement;

        $traitement=array('jour'=>'Jour30','Actions'=>"Eau simple");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour31','Actions'=>"Maladies respiratoires: Vental /Phytocuff/ Enrosol / Tylodox");
        $traitements[]=$traitement;

        $traitement=array('jour'=>'Jour32','Actions'=>"Maladies respiratoires: Vental /Phytocuff/ Enrosol / Tylodox");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour33','Actions'=>"Maladies respiratoires: Vental /Phytocuff/ Enrosol / Tylodox");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour34','Actions'=>"Maladies respiratoires: Vental /Phytocuff/ Enrosol / Tylodox");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour35','Actions'=>"Vermifuges: Sulfate de piperazine /levimasol /polystrongle");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour36','Actions'=>"Eau simple");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour37','Actions'=>"Eau simple");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour38','Actions'=>"Eau simple");
        $traitements[]=$traitement;
        $traitement=array('jour'=>'Jour39','Actions'=>"Vitamine: Amin'Total / Colivit AM+ / Vitamino /Lobamin layer");
        $traitements[]=$traitement;
        

        $pdf = PDF::loadView('vaccins.traitement',['data'=>$traitements]);
        $reference=date('d/m/Y')."-"."Traitement"."-".uniqid();
        return $pdf->download($reference.'.pdf');

       // dd('your pdf traitment');
    }
    

}
    