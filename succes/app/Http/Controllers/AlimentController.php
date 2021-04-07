<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use DB;
use Illuminate\Http\Request;
use App\Model\Aliment;
use App\Http\Controllers\CampagneController;
class AlimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //dd('here');
         //$aliments=Aliment::all();
         $aliments= DB::table('campagnes')
        ->join('aliments', function ($join) {
            $join->on('aliments.campagne_id', '=', 'campagnes.id')->whereStatus(['status'=>'EN COURS']);
        })
        ->orderByDesc('aliments.id')
        ->SimplePaginate(10);

         return view('aliments.index',compact('aliments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('here');
       // return view('aliments.create');
         return view('aliments.addMore');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campagne_id=0;
        $cam= new CampagneController();
       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($request->campagne));

         $rules=[
        //'campagne_id'=>'bail|required',   
         'campagne'=>'bail|required|min:9',
         'libelle'=>'bail|required|min:3',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
         'fournisseur'=>'required|min:4'
         //'obs'=>'required|min:3'
         ];
        $this->validate($request,$rules);

           Aliment::create([
            'campagne_id'=>$campagne_id,
            'date_achat'=>$request->date_achat,
            'campagne'=>Str::lower($request->campagne),
           'libelle'=>$request->libelle,
            'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
            'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs]);

      
        return redirect()->route('campaliments');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $aliments=Aliment::findOrFail($id);
         return view('aliments.show', compact('aliments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aliments=Aliment::findOrFail($id);
         return view('aliments.edit',compact('aliments'));
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
        $aliments=Aliment::findOrFail($id);

         $rules=[
         'campagne_id'=>'bail|required',   
         'campagne'=>'bail|required|min:9',
         'libelle'=>'bail|required|min:3',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
         'fournisseur'=>'required|min:4'
         //'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);

           $aliments->update([
            'campagne_id'=>$request->campagne_id,
            'date_achat'=>$request->date_achat,
            'campagne'=>Str::lower($request->campagne),
           'libelle'=>$request->libelle,
            'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
            'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs
        ]);

      
        return redirect()->route('aliments.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Aliment::destroy($id);
        return redirect()->route('aliments.index');
    }


   /**
   *
   */
   public function selectAllAlimentforthisCampagne($id){
       $result=array(); 
       $collections=DB::table('aliments')->whereCampagneId($id)->get();

        $result=$collections->toArray();
       // $result = json_decode($result, true);
         //dd($result);
       return  $result;

   }

    /**
     *
     *
     */

     public function calculateDepenseAlimentofthiscampagne($id){
        $som=0;

        $result=$this->selectAllAlimentforthisCampagne($id);

        for ($i=0; $i <count($result); $i++) { 

            $som+=$result[$i]->quantite*$result[$i]->priceUnitaire;
            //dd($som);
           // $som++;
     // dump($result[$i]->quantite." :".$result[$i]->priceUnitaire) ;
     }
    // dd($som);
     return $som;

     }

      /*
    * form to get form to select all aliments  of this campagne 
    */

    public function getAllAliments(){

        return view("aliments.allAliments_of_one_campagne");

    }
    /*
    *show all aliments  of this campagne 
    */
    
    public function showallAliments(){

        //dd('here');

    
       return view("aliments.showallAliments_of_one_campagne");

    }

    /*
    *generation pdf of this campagne
    */

    public function downloadRecapAliments($data)
    {
       
        $aliments= new Aliment();
       $results= $aliments->downloadRecapAliments($data);
    //dd($results);

    return $results;
       
    }




}
