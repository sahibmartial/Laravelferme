<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use DB;
use Illuminate\Http\Request;
use App\Model\Perte;
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
    $collections=$perte->selectDateStartCampagne($campagne_id);
     //dd($collections);
    foreach ($collections as $collection) {
   $date=$collection->start;
}
    $date1=strtotime(date("Y-m-d"));
   // dd($date1);
  
    $date2 = strtotime($collection->start);
   // dd($date2);
     $year=$perte->selectYearcreate($campagne_id);
    //dump($year);
    $duredevie=$perte->calculeDureVie($date1,$date2);
   //dd($duredevie) ;
//appel de ma fonction pour calculer le dure devie

     Perte::create([
            'campagne_id'=>$campagne_id,
            'campagne'=>Str::lower($request->campagne),
            'quantite'=>$request->quantite,
            'cause'=>$request->cause,
            //'priceUnitaire'=>$request->priceUnitaire,
           // 'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs,
            'duredevie'=>$duredevie,
            'year'=>$year
        ]);

      
        return redirect()->route('perte');   
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
       $pertes=Perte::findOrFail($id);

        $rules=[
         'campagne_id'=>'bail|required',  
         'campagne'=>'bail|required|min:9',
         'quantite'=>'bail|required'
     //    'priceUnitaire'=>'bail|required',
       //  'fournisseur'=>'required|min:4',
       //  'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);

        
       $pertes->update([
            'campagne_id'=>$request->campagne_id,
            'campagne'=>Str::lower($request->campagne),
            'quantite'=>$request->quantite
        //    'priceUnitaire'=>$request->priceUnitaire,
       //     'fournisseur'=>$request->fournisseur,
        //    'obs'=>$request->obs
    ]);

      
        return redirect()->route('pertes.show',$id); 


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Perte::destroy($id);
        return redirect()->route('perte');
    }


    /**
    *
    */
     
     public function selectAllLossOfThisCampagne($id){

         $result=array(); 
       $collections=DB::table('pertes')->whereCampagneId($id)->get();

        $result=$collections->toArray();
       // $result = json_decode($result, true);
        // dd($result);
       return  $result;
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



}
