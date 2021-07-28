<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Accessoire;
 use App\Http\Controllers\CampagneController;
 

class AccessoireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($this->calculateDepenseAccessoireofthiscampagne(2));
       // $accessoires=Accessoire::paginate(2);
       try {
        $accessoires= DB::table('campagnes')
        ->join('accessoires', function ($join) {
            $join->on('accessoires.campagne_id', '=', 'campagnes.id')->whereStatus(['status'=>'EN COURS']);
        })
        ->orderByDesc('accessoires.id')
        ->SimplePaginate(5);
       } catch (\Throwable $th) {
           throw $th;
       }
       //dd($accessoires);
        return view('accessoires.index', compact('accessoires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('accessoires.create');
        return view("accessoires.addMore_access");
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

       //dd($campagne_id);

         $rules=[
         //'campagne_id'=>'bail|required',   
         'campagne'=>'bail|required|min:9',
         'libelle'=>'bail|required|min:3',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
        // 'fournisseur'=>'required|min:4',
         'obs'=>'required|min:3'];
        $this->validate($request,$rules);
        
        try {
            Accessoire::create([
                'campagne_id'=>$campagne_id,
                'date_achat'=>$request->date_achat,
                'campagne'=>Str::lower($request->campagne),
               'libelle'=>$request->libelle,
                'quantite'=>$request->quantite,
                'priceUnitaire'=>$request->priceUnitaire,
               // 'fournisseur'=>$request->fournisseur,
                'obs'=>$request->obs]);
        } catch (\Throwable $th) {
             throw $th;
        }
          

      
        return redirect()->route('caccessoires');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // dd('here');
        try {
            $accessoires=Accessoire::findOrFail($id);
         return view('accessoires.show', compact('accessoires'));
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
    {  try {
        $accessoires=Accessoire::findOrFail($id);
         return view('accessoires.edit',compact('accessoires'));
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
      

         $rules=[
        'campagne_id'=>'bail|required',
         'campagne'=>'bail|required|min:9',
         'libelle'=>'bail|required|min:3',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
        // 'fournisseur'=>'required|min:4',
         'obs'=>'required|min:3'];
        $this->validate($request,$rules);

        try {
            $accessoire=Accessoire::findOrFail($id);
            $accessoire->update([
                'campagne_id'=>$request->campagne_id,
                'date_achat'=>$request->date_achat,
                'campagne'=>Str::lower($request->campagne),
               'libelle'=>$request->libelle,
                'quantite'=>$request->quantite,
                'priceUnitaire'=>$request->priceUnitaire,
               // 'fournisseur'=>$request->fournisseur,
                'obs'=>$request->obs]);
          
            
        } catch (\Throwable $th) {
            throw $th;
        }
       
        return redirect()->route('accessoires.show',$id);
         
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
        $folder="AccessoiresRemove/";
        $name=uniqid().'-'.date("Y-m-d H:i:s").'-'.$user->name;
        $filename=$name."."."txt";
        $filebackup= new BackUpFermeController();
        try {
            $value=Accessoire::findorfail($id);     
            $filebackup->backupfile($folder,$filename,$value);
            Accessoire::destroy($id);
        return redirect()->route('accessoires.index');
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
     /**
   *
   */
   public function selectAllAccessoireforthisCampagne($id){
       $result=array(); 
       try {
        $collections=DB::table('accessoires')->whereCampagneId($id)->get();
        $result=$collections->toArray();
       } catch (\Throwable $th) {
           //throw $th;
       }    
       // $result = json_decode($result, true);
         //dd($result);
       return  $result;

   }

    /**
     *
     *
     */

     public function calculateDepenseAccessoireofthiscampagne($id){
        $som=0;

        $result=$this->selectAllAccessoireforthisCampagne($id);

        for ($i=0; $i <count($result); $i++) { 

            $som+=$result[$i]->quantite*$result[$i]->priceUnitaire;
            //dd($som);
           // $som++;
     // dump($result[$i]->quantite." :".$result[$i]->priceUnitaire) ;
     }
    // dd($som);
     return $som;

     }

       /**
   *
   */
   public function selectAccessoireforthisCampagne($id){
       $result=array(); 
       try {
        $collections=DB::table('accessoires')->whereCampagneId($id)->get();
        $result=$collections->toArray();

       } catch (\Throwable $th) {
           throw $th;
       }
       // $result = json_decode($result, true);
         //dd($result);
       return  $result;

   }
   

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addMore()

    {

        return view("accessoires.addMore_access");

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addMorePost(Request $request)

    {
        $campagne_id=0;
        $campagne="";
        
//  dump($request->addmore);
        

        $cam= new CampagneController();
        $accessoire= new FonctionController();
        foreach ($request->addmore as $key => $value) {
             
             $campagne=$value['campagne'];
        }

       $campagne_id=$cam->getIntituleCampagneenCours($campagne);
       $arrayName =array('campagne_id'=> $campagne_id);
     // dump($arrayName);
      //dump($request->addmore);
      $collection=$request->addmore;
   
      $result=$accessoire->addmoreaccessoires($collection,$arrayName);
   
//dd($result);
        $request->validate([

            'addmore.*.campagne' => 'bail|required',

            'addmore.*.libelle' => 'bail|required',

            'addmore.*.quantite' => 'bail|required',

            'addmore.*.priceUnitaire' => 'bail|required',

            'addmore.*.obs' => 'bail|required',
            
        ]); 

        foreach ($result as $key => $value) {
            //dd($value);
           Accessoire::create($value);
        }
        return back()->with('success', 'Record Created Successfully.');

    }
    /*
    * form to get all accessoires of this campagne 
    */

    public function allAccessoires(){
      //  dd('her');
        return view("accessoires.allAccessoires");

    }
    /*
    *show all accessoires of this campagne select 
    */
    
    public function showallaccesoires(){

        $accessoire= new Accessoire();
         //$accessoire->
       // $campagne="";
     ///  dd("in");
    
       return view("accessoires.showall");

    }
   /**
    * generation de pdf accessoires
    * 
    */ 

    public function downloadRecapAccessoires($data)
    {
        $accessoires= new Accessoire();
       $results=$accessoires->downloadRecapAccessoires($data);
    //dd($results);

    return $results;

    }



}
