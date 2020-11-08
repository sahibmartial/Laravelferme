<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use DB;
use Illuminate\Http\Request;
use App\Model\Transport;
use App\Http\Controllers\CampagneController;
class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $transports=Transport::all();

         $transports= DB::table('campagnes')
        ->join('transports', function ($join) {
            $join->on('transports.campagne_id', '=', 'campagnes.id')->whereStatus(['status'=>'EN COURS']);
        })
        ->SimplePaginate(10);

      //  dd($transports);

        return view('transports.index',compact('transports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dump($request);

        $campagne_id=0;
        $cam= new CampagneController();
       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($request->campagne));
        //dd($campagne_id);
         $rules=[
         'campagne'=>'bail|required|min:9',
         //'libelle'=>'bail|required|min:3',
         'montant'=>'bail|required',
         //'priceUnitaire'=>'bail|required',
        // 'fournisseur'=>'required|min:4'
         'obs'=>'required|min:3'
         ];
        $this->validate($request,$rules);

           Transport::create([
            'campagne_id'=>$campagne_id,
            'date_achat'=>$request->date_achat,
            'campagne'=>Str::lower($request->campagne),
           //'libelle'=>$request->libelle,
            'montant'=>$request->montant,
          //  'priceUnitaire'=>$request->priceUnitaire,
           // 'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs]);

      
        return redirect()->route('transport');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transports=Transport::findOrFail($id);
        return view('transports.show',compact('transports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $transports=Transport::findOrFail($id);
         return view('transports.edit',compact('transports'));
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
         $transports=Transport::findOrFail($id);

         $rules=[
         'campagne_id'=>'bail|required',  
         'campagne'=>'bail|required|min:9',
         //'libelle'=>'bail|required|min:3',
         'montant'=>'bail|required',
        // 'priceUnitaire'=>'bail|required',
        // 'fournisseur'=>'required|min:4'
         'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);

          $transports->update([
            'campagne_id'=>$request->campagne_id,
            'date_achat'=>$request->date_achat,
            'campagne'=>Str::lower($request->campagne),
         //  'libelle'=>$request->libelle,
            'montant'=>$request->montant,
          //  'priceUnitaire'=>$request->priceUnitaire,
            //'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs
        ]);

      
        return redirect()->route('transports.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transport::destroy($id);
        return redirect()->route('transports.index');
    }
    

    /**
    *
    */

   public function selectAllFraisTrasnportForOneCampagne($id){

   $result=array(); 
       $collections=DB::table('transports')->whereCampagneId($id)->get();

        $result=$collections->toArray();
       // $result = json_decode($result, true);
        // dd($result);
       return  $result;
    }

    /**
     *
    */

    public function calculateFraisTotalOfCampagne($id){
        $som=0;

        $result=$this->selectAllFraisTrasnportForOneCampagne($id);

        for ($i=0; $i <count($result); $i++) { 

            $som+=$result[$i]->montant;
            //dd($som);
           // $som++;
     // dump($result[$i]->quantite." :".$result[$i]->priceUnitaire) ;
     }
    // dd($som);
     return $som;
 }

  /*
    * form to get all accessoires of this campagne 
    */

    public function allTransports(){

        return view("transports.allTransports_of_one_campagne");

    }
    /*
    *show all accessoires of this campagne select 
    */
    
    public function showallTransports(){

        //dd('here');
    
       return view("transports.showallTransports_of_one_campagne");

    }

}
