<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
        // dd('here');
         //$aliments=Aliment::all();

         try {
            $aliments= DB::table('campagnes')
            ->join('aliments', function ($join) {
                $join->on('aliments.campagne_id', '=', 'campagnes.id')->whereStatus(['status'=>'EN COURS']);
            })
            ->orderByDesc('aliments.id')
            ->SimplePaginate(10);
         } catch (\Throwable $th) {
             throw $th;
         }
        

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
          try {
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
    {   try {
        $aliments=Aliment::findOrFail($id);
         return view('aliments.show', compact('aliments'));
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
      //  dd($id);
        try {
            $aliments=Aliment::findOrFail($id);
         return view('aliments.edit',compact('aliments'));
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
      // dd($request);
        $aliments=Aliment::findOrFail($id);

         $rules=[
         'campagne_id'=>'bail|required',   
         'campagne'=>'bail|required|min:9',
         'libelle'=>'bail|required|min:3',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
         'fournisseur'=>'required|min:4',
         'date_achat'=>'bail|required'
         //'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);
         try {
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
        $folder="AlimentsRemove/";
        $name=uniqid().'-'.date("Y-m-d H:i:s");
        $filename=$name."."."txt";
        $filebackup= new BackUpFermeController();

        try {
            $value=Aliment::findorfail($id);     
           $filebackup->backupfile($folder,$filename,$value);
            Aliment::destroy($id);
            return redirect()->route('aliments.index');
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }


   /**
   *
   */
   public function selectAllAlimentforthisCampagne($id){
       $result=array(); 
       try {
        $collections=DB::table('aliments')->whereCampagneId($id)->get();
        $result=$collections->toArray();
        // $result = json_decode($result, true);
          //dd($result);
        return  $result;
       } catch (\Throwable $th) {
           throw $th;
       }
    
   }

/*** 
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
