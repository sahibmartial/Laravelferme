<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Form;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\Vente;
use App\Http\Controllers\CampagneController;
use Illuminate\Support\Facades\DB;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$ventes=Vente::all();

        try {
            $ventes= DB::table('campagnes')
        ->join('ventes', function ($join) {
            $join->on('ventes.campagne_id', '=', 'campagnes.id')->whereStatus(['status'=>'EN COURS']);
        })
        ->orderByDesc('ventes.id')
        ->SimplePaginate(10);
        } catch (\Throwable $th) {
            throw $th;
        }
        
       // dd($this->handle());

        return view('ventes.index',compact('ventes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // echo Form::select('size', array('L' => 'Large', 'S' => 'Small'), 'S');
        return view('ventes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regler="";
          Str::lower($request->campagne);
          //dump($request->acheteur);
         // dd($request);
        $cam= new CampagneController();
       try {
        $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($request->campagne));
        if($campagne_id==null)
        {
            //dd('camapgne found '.$campagne_id);
 
            return back()->with('success', $request->campagne.'introuvable, Enregistrement de la vente impossible, revoyer vos champs');
        }

        $rules=[
            'date'=>'bail|required',  
            'campagne'=>'bail|required|min:9',
            'quantite'=>'bail|required',
            'priceUnitaire'=>'bail|required',
            'acheteur'=>'required|min:4',
            'events'=>'required|min:4',
            //'obs'=>'required|min:3'
        ];
           $this->validate($request,$rules);
           if ( ($request->avance==null || $request->avance==0 ) && ($request->impaye==null || $request->impaye==0)) {
            $regler="OK";
            Vente::create([
               'campagne_id'=>$campagne_id,
               'date'=>$request->date,
               'campagne'=>Str::lower($request->campagne),
               'quantite'=>$request->quantite,
               'priceUnitaire'=>$request->priceUnitaire,
               'acheteur'=>$request->acheteur,
               'contact'=>$request->contact,
               'events'=>$request->events,
               'avance'=>$request->avance,
               'impaye'=>$request->impaye,
                'regler'=>$regler,
               'obs'=>$request->obs
               ]);
           // dd( $regler);
           } else {
               $regler="NOK";
              // dd( $regler);
              $netapayer=($request->quantite * $request->priceUnitaire);
   
              //cehck if a_payer  == avance + impayer
   
              if ( $netapayer==($request->avance + $request->impaye)) {
                // dd($request);
                try {
                   Vente::create([
                       'campagne_id'=>$campagne_id,
                       'date'=>$request->date,
                       'campagne'=>Str::lower($request->campagne),
                       'quantite'=>$request->quantite,
                       'priceUnitaire'=>$request->priceUnitaire,
                       'acheteur'=>$request->acheteur,
                       'contact'=>$request->contact,
                       'events'=>$request->events,
                       'avance'=>$request->avance,
                       'impaye'=>$request->impaye,
                       'regler'=>$regler,
                       'obs'=>$request->obs
                   ]);     
                    
                } catch (\Throwable $th) {
                    throw $th;
                }
              
               return redirect()->route('ventes.index')->with('success', 'vente été enregistrée avec success, merci ');
              }else {
   
                  return back()->with('success', 'Enregistrement Impossible, montant net à payer: '.$netapayer
                  .' et somme avance: '.$request->avance.' plus, impaye: '.$request->impaye. ' different');
              }      
   
           } 
           
       } catch (\Throwable $th) {
           throw $th;
       }
     
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $ventes=Vente::findOrFail($id);
            return view('ventes.show',compact('ventes'));
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $ventes=Vente::findOrFail($id);
            return view('ventes.edit',compact('ventes'));
        } catch (\Throwable $th) {
            throw $th;
        }
       
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
        $regler="";
        $rules=[
            'campagne_id'=>'bail|required',  
            'campagne'=>'bail|required|min:9',
            'quantite'=>'bail|required',
            'priceUnitaire'=>'bail|required',
            'acheteur'=>'required|min:4',
            'events'=>'required|min:4',
            //'obs'=>'required|min:3'
        ];
        $this->validate($request,$rules);
        $netapayer=($request->quantite * $request->priceUnitaire);

        try {
            $ventes=Vente::findOrFail($id);
           
            if ($request->avance==0 && $request->impaye==0) {
                $regler="OK";
              // dd($request);
                $ventes->update([
                    'campagne_id'=>$request->campagne_id,
                    'campagne'=>Str::lower($request->campagne),
                    'quantite'=>$request->quantite,
                    'priceUnitaire'=>$request->priceUnitaire,
                    'acheteur'=>$request->acheteur,
                    'contact'=>$request->contact,
                    'events'=>$request->events,
                    'avance'=>$request->avance,
                    'impaye'=>$request->impaye,
                    'regler'=>$regler,
                    'obs'=>$request->obs
               ]);
               return redirect()->route('ventes.show',$id)->with('success','Modification reussie avec success'); 
                
            }elseif(($netapayer==$request->avance) && $request->impaye==0){
                $regler="OK";
                $ventes->update([
                    'campagne_id'=>$request->campagne_id,
                    'campagne'=>Str::lower($request->campagne),
                    'quantite'=>$request->quantite,
                    'priceUnitaire'=>$request->priceUnitaire,
                    'acheteur'=>$request->acheteur,
                    'contact'=>$request->contact,
                    'events'=>$request->events,
                    'avance'=>$request->avance,
                    'impaye'=>$request->impaye,
                    'regler'=>$regler,
                    'obs'=>$request->obs
               ]);
                return redirect()->route('ventes.show',$id)->with('success','Modification reussie avec success'); 
            }else {
                $regler="NOK";

                if ($netapayer == ($request->avance + $request->impaye)) {

                    $ventes->update([

                        'campagne_id'=>$request->campagne_id,
                        'campagne'=>Str::lower($request->campagne),
                        'quantite'=>$request->quantite,
                        'priceUnitaire'=>$request->priceUnitaire,
                        'acheteur'=>$request->acheteur,
                        'contact'=>$request->contact,
                        'events'=>$request->events,
                        'avance'=>$request->avance,
                        'impaye'=>$request->impaye,
                        'regler'=>$regler,
                        'obs'=>$request->obs
                   ]);
                   return redirect()->route('ventes.show',$id)->with('success','Modification reussie avec success'); 
                    
                } else {
                    return back()->with('success', 'Modification Impossible, montant net à payer: '.$netapayer
                  .' et somme avance: '.$request->avance.' plus, impaye: '.$request->impaye. ' different');
                }           
                
            }    
            
        } catch (\Throwable $th) {
            throw $th;
        }

        
      
      
      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder="VenteRemove/";
        $name=uniqid().'-'.date("Y-m-d H:i:s");
        $filename=$name."."."txt";
        $filebackup= new BackUpFermeController();
       
        try {
        $value=Vente::findorfail($id);     
        $filebackup->backupfile($folder,$filename,$value);
        Vente::destroy($id);
        //dd($value);  
        return redirect()->route('vente');
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }

    public function selectAllSaleForOneCampagne($id)
    {

     $result=array(); 
     try {
        $collections=DB::table('ventes')->whereCampagneId($id)->get();
        $result=$collections->toArray();
        // $result = json_decode($result, true);
 
        return  $result;

     } catch (\Throwable $th) {
         throw $th;
     }
     
       
    }

    public function calculateVenteOfCampagne($id){
        $som=0;

        $result=$this->selectAllSaleForOneCampagne($id);

        for ($i=0; $i <count($result); $i++) { 

            $som+=$result[$i]->quantite*$result[$i]->priceUnitaire;
            //dd($som);
           // $som++;
     // dump($result[$i]->quantite." :".$result[$i]->priceUnitaire) ;
     }
     //dd($som);
     return $som;
 }

 public function info($var)
 {
    return $var ;
 }

   public function handle()
{
    /*$name = $this->anticipate(
        'What is your name?',
        ['Jim', 'Conchita']
    );*/
    $name="sahib";

    $this->info($name);

   /* $source = $this->choice(
        'Which source would you like to use?',
        ['master', 'develop']
    );*/

    //$this->info("Source chosen is $source");
}

public function getRecap()
{
    $recap = new Vente();
    

    return view('ventes.recap');
    
}

public function getRecapShow(Request $request)
{
    $campagne=$request->campagne;
    $recap = new Vente();
   $result= $recap->getRecapShow($request->campagne);
   if (!empty($result)) {
   // dd($result);
     return view('ventes.recapShow',compact('result','campagne'));
      
   }else{
   
    $result=[];
    return view('ventes.recap',compact('result'));
    //return redirect()->route('recap_vente')->with('Result', 'Not found for this campagne');
   }    
    
}

public function calculRecapvente($request)
{
     $recap = new Vente();
     $result= $recap->calculRecapvente($request);

     return  $result;
}


/**
* generation du pdf du detail des ventes d'une vcampagne
*/
    
 public function downloadRecapVente($data)
 {
    $vente= new Vente();
    $results=$vente->downloadRecapVente($data);
    return $results;
    
 }
 

 /**
  * recup data vente campagne en cours
  */

  public function ventes_campagne_en_cours()
  {
     
    $resultqte=array();
    $resultdate=array();
    $campagne='';
    $vente= new Vente();
    $resultsVentes=$vente->ventes_campagne_en_cours();
    
    if ($resultsVentes->isNotEmpty()) {
      // dd($resultsVentes);
        if (isset($resultsVentes[0]['campagne'])) {
            $campagne=$resultsVentes[0]['campagne'];
            foreach ($resultsVentes as $key => $value) {
               // dd($value);
                $resultqte[]=$value['quantite'];
                $resultdate[]=$value['date'];
               }           

        }else{

            return 'Pas de vente Disponible  ';
        }  
     
    }
   
    return array('campagne'=> $campagne,'qte'=>$resultqte,'dateVente'=> $resultdate);
  }
  /**
   * get ventes impayés
   */
  public function ventes_impayes()
  {
      $vente = new Vente();
      $venteimpayes=$vente->ventes_impayes();
     // dd($venteimpayes);
      return view('ventes.recapVentesImpayes',compact('venteimpayes'));
  }
 

/**
 * get Ventes inmpayés de la campagne en cours 
*/
public function ventes_regler()
 {
    $vente = new Vente();
    $ventepayes=$vente->ventes_regler();
    return $ventepayes;
   
 }
  
 
}
