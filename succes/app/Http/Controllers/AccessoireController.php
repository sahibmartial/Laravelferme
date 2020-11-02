<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use DB;
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
       // $accessoires=Accessoire::paginate(2);
        $accessoires= DB::table('campagnes')
        ->join('accessoires', function ($join) {
            $join->on('accessoires.campagne_id', '=', 'campagnes.id')->whereStatus(['status'=>'EN COURS']);
        })
        ->SimplePaginate(2);

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
    /*    for ($i=0; $i <$id->count(); $i++) { 
    //dd($id);
     $resultid[]=$id[$i]->id;
     $resultname[]=$id[$i]->intitule;

      if($request->campagne == $id[$i]->intitule){
         $campagne_id=$id[$i]->id;
      }

     }*/
     
     //check campagne_id
    
        

         $rules=[
         //'campagne_id'=>'bail|required',   
         'campagne'=>'bail|required|min:9',
         'libelle'=>'bail|required|min:3',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
        // 'fournisseur'=>'required|min:4',
         'obs'=>'required|min:3'];
        $this->validate($request,$rules);

           Accessoire::create([
            'campagne_id'=>$campagne_id,
            'campagne'=>Str::lower($request->campagne),
           'libelle'=>$request->libelle,
            'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
           // 'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs]);

      
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
        
         $accessoires=Accessoire::findOrFail($id);
         return view('accessoires.show', compact('accessoires'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $accessoires=Accessoire::findOrFail($id);
         return view('accessoires.edit',compact('accessoires'));
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
       $accessoire=Accessoire::findOrFail($id);

         $rules=[
        'campagne_id'=>'bail|required',
         'campagne'=>'bail|required|min:9',
         'libelle'=>'bail|required|min:3',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
        // 'fournisseur'=>'required|min:4',
         'obs'=>'required|min:3'];
        $this->validate($request,$rules);

           $accessoire->update([
            'campagne_id'=>$request->campagne_id,
            'campagne'=>Str::lower($request->campagne),
           'libelle'=>$request->libelle,
            'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
           // 'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs]);

      
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
        Accessoire::destroy($id);
        return redirect()->route('accessoires.index');
    }
     /**
   *
   */
   public function selectAllAccessoireforthisCampagne($id){
       $result=array(); 
       $collections=DB::table('accessoires')->whereCampagneId($id)->get();

        $result=$collections->toArray();
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
       $collections=DB::table('accessoires')->whereCampagneId($id)->get();

        $result=$collections->toArray();
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
        
  //dd($request->addmore);
        

        $cam= new CampagneController();
        $aliment= new FonctionController();
        foreach ($request->addmore as $key => $value) {
             
             $campagne=$value['campagne'];
        }

       $campagne_id=$cam->getIntituleCampagneenCours($campagne);
       $arrayName =array('campagne_id'=> $campagne_id);
     // dump($arrayName);
    //  dd($request->addmore);
      $collection=$request->addmore;

      $result=$aliment->addmoreaccessoires($collection,$arrayName);
   

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



}
