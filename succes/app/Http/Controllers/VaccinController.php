<?php

namespace App\Http\Controllers;

use App\Model\Vaccin;
use App\Campagne;
use Illuminate\Http\Request;
use App\Http\Controllers\GeneratePdfController;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * ClientController short of the class
 * 
 * @category CategoryName
 * @package  PackageName
 * @author   Original Author <author@example.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://pear.php.net/package/PackageName
 */
class VaccinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vaccins =DB::table('campagnes')
            ->join('vaccins', function ($join) {
                $join->on('vaccins.campagne_id', '=', 'campagnes.id')->whereStatus(['status' => 'EN COURS']);
            })
            ->orderByDesc('vaccins.id')
            ->SimplePaginate(5);
        } catch (\Throwable $th) {
            return "Erreur dans la requete SQL";
        }
        if (!empty($vaccins->items())) {
            return view('vaccins.index', compact('vaccins'));   
        } else {
            return back()->with('success', 'Aucun suivi de vaccin en cours actuellement');
        }       

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
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store( Vaccin $vaccin,Request $request)
    { 
        $id=null;
        $suivi= $vaccin->infosCampagneStatus("EN COURS");
        //  dump($suivi);
        $id=$suivi[0]['id'];
        //  dd($id);
         
        $arrayIntervention=[];
        //preparez un array ou je parcours les select et jes ordonne dans une ligne unique pour insertion plus simple 
        
         $select=$request->intitulevaccin;
        //dd($select[0]);
        
        if (count($select)>1) {
            for ($i=0; $i <count($select); $i++) { 
                $arrayIntervention[]= array('id_camp'=>$id,'campagne'=>$request->campagne,'date'=>$request->datevaccination,'intitulevaccin'=>$select[$i],'obs'=>$request->obs); 
            } 
               //  dd($arrayIntervention);
        } else {
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
                $this->validate($request, $rules);

                if (count($suivi)>=1) {
                    // dump($suivi);
                    Vaccin::create(
                        [
                        'campagne_id'=>$suivi['id_camp'],
                        'campagne'=>$suivi['campagne'],
                        'datedevaccination'=>$suivi['date'],
                        'intitulevaccin'=>$suivi['intitulevaccin'],
                        'obs'=>$suivi['obs']

                        ]
                    );
            
                } else {
                    throw new \Throwable("Enregistrement vaccin impossible");
                }

            } catch (\Throwable $th) {
                // dd($th->getMessage());
                 return redirect()->route('errors.bdInsert')->with('success', $th->getMessage());
            }
         
        }
           //  die();
           return redirect()->route('vaccins.index')->with('success', 'Vaccination  enregistré avec sucess');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * 
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
       
     
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suivi=Vaccin::findOrFail($id);
  
        return view('vaccins.edit', compact('suivi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param\Illuminate\Http\Request $request
     * 
     * @param\App\Model\Vaccin $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      
        try {
            $suivi=Vaccin::findOrFail($id);
            //   dd($suivi);
            if ($id) {
              
                $rules=[
                    'campagne'=>'required|min:9',
                     'datevaccination'=>'bail|required',
                    'intitulevaccin'=>'bail|required',
                    'obs'=>'required|min:3'];
                    $this->validate($request, $rules);
                   // dd("here IN");
                    $suivi->update(
                        [
                        'campagne_id'=>$request->campagne_id,
                        'campagne'=>$request->campagne,
                        'datedevaccination'=>$request->datevaccination,
                        'intitulevaccin'=>$request->intitulevaccin,
                        'obs'=>$request->obs

                        ]
                    ); 
                      
            
            } else {
                throw new \Throwable("Modification vaccin impossible");
            }
        } catch (\Throwable $th) {
             //   dd($th->getMessage());
             return redirect()->route('errors.bdInsert')->with('success', $th->getMessage());
        }

        return redirect()->route('vaccin')->with('success', 'Vaccin modifié avec sucess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param\App\Model\Vaccin $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=Auth()->user();
        $folder="VaccinRemove/";
        $name=uniqid().'-'.date("Y-m-d H:i:s").'-'.$user->name;
        $filename=$name."."."txt";
        $filebackup= new BackUpFermeController();
        try {
            $value=Vaccin::findorfail($id);
        
            $filebackup->backupfile($folder, $filename, $value);

            Vaccin::destroy($id);
            return redirect()->route('vaccin')->with('success', 'Vaccin  supprimé avec sucess');
        
        } catch (\Throwable $th) {
            //  throw $th;
            return "Vaccin not found";
        }
       
    }
    /**
     * Form to download recap traitement
     * 
     * @return void
     */
    public function recapVaccin()
    {
        return view('vaccins.recapVaccin');
    }
    /**
     * Listing traitement vaccin pdf generation du fichier pdf
     * 
     * @return $request
     */
    public function getRecap(Request $request)
    {   
         $pdf= new GeneratePdfController();

        $vaccin= new Vaccin();
        $data=$vaccin->getRecap($request->campagne);
        //  dd();
        if (count($data)>0) {
             $pdf = PDF::loadView('vaccins.pdf_suivivaccin', ['campagne'=>$request->campagne,'data'=>$data]);
       
    
            $reference=date('d/m/Y')."-"."RecapTraitement".$request->campagne."-".uniqid();
              // dd( $reference);
              return $pdf->download($reference.'.pdf');  
        }
        return back()->with('success', 'Impossible de télécharger pdf, aucun suivi trouvé pour cette campagne');
          

    }    
    /**
     * TreatmentCampagneEnCours
     *
     * @return \Illuminate\Http\Response
     */
    public function treatmentCampagneEnCours()
    {
        try {
            $campagnes=Campagne::whereStatus("EN COURS")
                ->orderByDesc('id')
                ->SimplePaginate(10);
              //  ->get(['id','intitule']);
        } catch (\Throwable $th) {
            return 'Error Staut not found';
        }
         // dd($campagnes); 
        return view('vaccins.treatCampagne', compact('campagnes'));
    }
   
    /**
     * Generation Pdf suivi des traitements pour chaque campagne
     * 
     * @return $response
     */
    public function traitement_pdf($id)
    {  
         //dd($id);
        $traitements=[];
        try {
            $campagnes=Campagne::whereId($id)->get('intitule');
            $datearrivePousin=Campagne::find($id)
                ->poussins()->where('campagne_id', $id)
                ->get('date_achat'); 
        } catch (\Throwable $th) {
            return " ID Campagne introuvable: ".$id;
        }
        
        if ($datearrivePousin->isNotEmpty()) {
             //step Mise en production
            $datepoussins = new Carbon($datearrivePousin[0]['date_achat']);
            $date_vente=$datepoussins->add(45, 'day');

            $production=array('Campagne'=>$campagnes[0]['intitule'], 'Date'=>date_format($date_vente, 'd-m-Y'), 'Actions'=>'Démarrage des ventes ');
            $traitements['production']=$production;

            //Step Traitements
            for ($i=0; $i < 40; $i++) { 
                
                $datepoussins = new Carbon($datearrivePousin[0]['date_achat']);
                $jour=$datepoussins->add($i, 'day');
                 $value=$i+1;
                $day='Jour'.$value;
                switch ( $value) {

                case ($value==1):
                    $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'), 'Actions'=>' Pulverisations quotidien tous les 3 jours | Au sucré /Mixtral /BetaSpro-C');
                    $traitements['traitement'][]=$traitement;   
                    break;
                case ($value==2):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>'ANTISTRESS : Supervitassol / Panthéryl / Alfaceril');
                        $traitements['traitement'][]=$traitement;
                    break;
                case ($value==3):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>'ANTISTRESS : Supervitassol / Panthéryl / Alfaceril');
                        $traitements['traitement'][]=$traitement;
                    break;
                    
                case  ($value==4):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>'ANTISTRESS : Supervitassol / Panthéryl / Imuneo');
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==5):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>'Vaccin : 1er vaccin HB1 |  1er vaccin H120  | SuperVitassol :  Panthéryl / Imuneo');
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==6):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>' Supervitassol / Panthéryl / Imuneo');
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==7):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>' Eau simple');
                        $traitements['traitement'][]=$traitement;
                    break;
                case ($value==8):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>' Eau simple');
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==9):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>' VITAMINES : AmineTotal / Supervitassol');
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==10):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>' Vaccin: 1er vaccin de GUMBHORO | VITAMINES : AmineTotal / Vitaminolyte Super');
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==11):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super");
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==12):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super");
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==13):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>' Eau simple');
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==14):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>' Eau simple');
                        $traitements['traitement'][]=$traitement;
                    break;

                case  ($value==15):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>' Eau simple');
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==16):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>' Eau simple');
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==17):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super");
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==18):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Vaccin :2ième rappel vaccin  GUMBHORO");
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==19):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super");
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==20):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Eau simple");
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==21):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Phase de Transition Alimentaire:3/4 Aliment de démarrage + 1/4 Aliment croissance | Anticoccidiens: Vetacox /Anticox");
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==22):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Phase de Transition Alimentaire:1/2 Aliment de démarrage + 1/2 Aliment croissance | Anticoccidiens: Vetacox /Anticox");
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==23):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Phase de Transition Alimentaire:1/4 Aliment de démarrage + 3/4 Aliment croissance | Anticoccidiens: Vetacox /Anticox");
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==24):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Anticoccidiens: Vetacox / Anticox");
                        $traitements['traitement'][]=$traitement;
                    break;

                case ($value==25):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Anticoccidiens: Vetacox / Anticox");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==26):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Vitamines : Amin'Total");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==27):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Vaccin: 2ième rappel vaccin HB1 | 2ième rappel vaccin H120 | Vitamines: Amin'Total");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==28):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Eau simple");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==29):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>" Vaccin: 3ième rappel vaccin GUMBORHO: HIPRAGUMBORO GM97 / CEVAC IBDL /AVI IBD PLUS / NOBILIS 228E");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==30):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Eau simple");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==31):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Maladies respiratoires: Vental /Phytocuff/ Enrosol / Tylodox");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==32):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Maladies respiratoires: Vental /Phytocuff/ Enrosol / Tylodox");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==33):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Maladies respiratoires: Vental /Phytocuff/ Enrosol / Tylodox");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==34):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Maladies respiratoires: Vental /Phytocuff/ Enrosol / Tylodox");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==35):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Vermifuges: Sulfate de piperazine /levimasol /polystrongle");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==36):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Eau simple");
                         $traitements['traitement'][]=$traitement;
                    break;

                case ($value==37):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Eau simple");
                         $traitements['traitement'][]=$traitement;
                    break;
                    
                case ($value==38):
                         $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Eau simple");
                          $traitements['traitement'][]=$traitement;
                    break;

                case ($value==39):
                        $traitement=array('jour'=>$day,'Date'=>date_format($jour, 'd-m-Y'),'Actions'=>"Vitamine: Amin'Total / Colivit AM+ / Vitamino /Lobamin layer");
                         $traitements['traitement'][]=$traitement;
                    break;

                default:
                        # code...
                    break;
                }
               
            }
           // echo(date_format( $jour2, 'Y-m-d') );
        }else{

            return back()->with('success', 'Date arrivée poussin '.$campagnes[0]['intitule']." introuvalbe");
        }

         // dd( $traitements); 
    
        $pdf = PDF::loadView('vaccins.traitement', ['data'=>$traitements]);
      
        $reference=date('d/m/Y')."-"."Traitement"."-".uniqid();
        return $pdf->download($reference.'.pdf');

    }
    

}
    