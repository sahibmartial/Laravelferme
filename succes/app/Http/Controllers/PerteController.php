<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Perte;
use App\Model\Poussin;
use App\Http\Controllers\CampagneController;

class PerteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        //dd('here');
        //$pertes=Perte::all();

         $pertes= DB::table('campagnes')
        ->join('pertes', function ($join) {
            $join->on('pertes.campagne_id', '=', 'campagnes.id')->whereStatus(['status'=>'EN COURS']);
        })
        ->orderByDesc('pertes.id')
        ->SimplePaginate(10);


        return view('pertes.index',compact('pertes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('here');
        return view('pertes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  dd('here');
        //$date="";
        $cam= new CampagneController();
       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($request->campagne));
       //dd($campagne_id);
        $rules=[
        // 'campagne_id'=>'bail|required',   
         'campagne'=>'bail|required|min:9',
         'quantite'=>'bail|required',
         'cause'=>'required|min:3',
         //'priceUnitaire'=>'bail|required',
        //'fournisseur'=>'required|min:4',
       //  'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);

    $perte= new CampagneController();
    //dd($campagne_id);
    try {
        $poussins=Poussin::whereCampagneId($campagne_id)->get('date_achat');
    } catch (\Throwable $th) {
        return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
    }
   
   // dd($poussins[0]['date_achat']);
    $collections=$perte->selectDateStartCampagne($campagne_id);
     //dd($collections);
    foreach ($collections as $collection) {
   $date=$collection->start;
     }

    $date1=strtotime(date("Y-m-d"));
   // dd($date1);
    $date_die=strtotime($request->date_die);
  
    $date2 = strtotime($poussins[0]['date_achat']);
   // dd($date2);
     $year=$perte->selectYearcreate($campagne_id);
    //dump($year);
    $duredevie=$perte->calculeDureVie($date_die,$date2);
  // dd($duredevie) ;
//appel de ma fonction pour calculer le dure devie
  try {
    Perte::create([
        'campagne_id'=>$campagne_id,
        'date_die'=>$request->date_die,
        'campagne'=>Str::lower($request->campagne),
        'quantite'=>$request->quantite,
        'cause'=>$request->cause,
        //'priceUnitaire'=>$request->priceUnitaire,
       // 'fournisseur'=>$request->fournisseur,
        'obs'=>$request->obs,
        'duredevie'=>$duredevie,
        'year'=>$year
    ]);
  } catch (\Throwable $th) {
    return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
  }
      
       //return redirect()->route('perte');   
         return redirect()->route('pertes.index')->with('success', 'Perte has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $lists=Perte::findOrFail($id);
        
         return view('pertes.show', compact('lists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertes=Perte::findOrFail($id);

        return view('pertes.edit',compact('pertes'));
        
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
     
     // dd($request);
        $cam= new CampagneController();
       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($request->campagne));
      
       $rules=[
        'campagne_id'=>'bail|required',  
        'campagne'=>'bail|required|min:9',
        'quantite'=>'bail|required'
       // 'priceUnitaire'=>'bail|required',
      //  'fournisseur'=>'required|min:4',
      //  'obs'=>'required|min:3'
            ];
       $this->validate($request,$rules);
       $collections=$cam->selectDateStartCampagne($campagne_id);
       foreach ($collections as $collection) {
        $date=$collection->start;
        }

       $date_die=strtotime($request->date_die);
 
      $date2 = strtotime($collection->start);
      $duredevie=$cam->calculeDureVie($date_die,$date2);

       try {
        $pertes=Perte::findOrFail($id);
        $pertes->update([
          'campagne_id'=>$request->campagne_id,
          'date_die'=>$request->date_die,
          'campagne'=>Str::lower($request->campagne),
          'quantite'=>$request->quantite,
          'duredevie'=>$duredevie,
      //     'fournisseur'=>$request->fournisseur,
          'suggestion'=>$request->suggest
        ]);
      return redirect()->route('pertes.show',$id); 

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
      $user=Auth()->user();
      $folder="PerteRemove/";
      $name=uniqid().'-'.date("Y-m-d H:i:s").'-'.$user->name;
      $filename=$name."."."txt";
      $filebackup= new BackUpFermeController();
        try {

         $value=Perte::findorfail($id); 
         $filebackup->backupfile($folder,$filename,$value);
         Perte::destroy($id);
        return redirect()->route('perte');
    
        } catch (\Throwable $th) {
         throw $th;
       }
        
    }


    /**
    *
    */
     
     public function selectAllLossOfThisCampagne($id)
     {  
       $result=array(); 

       try {
        $collections=DB::table('pertes')->whereCampagneId($id)->get();
        $result=$collections->toArray();
        return  $result;       
       } catch (\Throwable $th) {
         throw $th;
       }
          
       // $result = json_decode($result, true);
        // dd($result);
     
     }


     /**
     *
     *
     */

     public function calculateTotalLossofthiscampagne($id){
        $som=0;

        $result=$this->selectAllLossOfThisCampagne($id);

        for ($i=0; $i <count($result); $i++) { 

            $som+=$result[$i]->quantite;
            //dd($som);
           // $som++;
     // dump($result[$i]->quantite." :".$result[$i]->priceUnitaire) ;
     }
    // dd($som);
     return $som;

     }

 
    /**
     *get form to select all losing of this campaign
     *
     */
    public function getAll_losing(){

        return view("pertes.getAll_losing");

    }


   /**
     *show  all losing of this campaign
     *
     */
    public function showAll_losing(){

         // dd('show losing !!!!');
         return view("pertes.showAll_losing");
        
    }



    /**
     *calcule total pertes of this campagne
     *
     */
    public function pertesOfthisCampagne($value)
    {
        $perte=new Perte();
        $result =$perte->pertesOfthisCampagne($value);

         return $result;
        
    }
/**
* generation du pdf des pertes d'une campagne
*/
    
 public function downloadRecapPerte($data)
 {
    $pertes= new Perte();
    $results=$pertes->downloadRecapPerte($data);
    return $results;
 }

/**
 * get perstes campagne en cours 
 */
 
 public function pertes_campagne_en_cours()
 {
   $resultqte=array();
   $resultdate=array();
   $campagne='';
   $perte= new Perte();
   $resultsPertes=$perte->pertes_campagne_en_cours();
   if ($resultsPertes=='Campagne introuvable') {
    return 'Aucune campagne en cours !';
   }else {
      if (isset($resultsPertes[0]['campagne'])) {
        $campagne=$resultsPertes[0]['campagne'];
        //  dd($campagne);
      foreach ($resultsPertes as $key => $value) {
      // dd($value);
        $resultqte[]=$value['quantite'];
        $resultdate[]=$value['date_die'];
        }
      } 
   }
 //  dd(   $resultqte,$resultdate);
   return array('campagne'=> $campagne,'qte'=>$resultqte,'dateDie'=> $resultdate);
 }

}
