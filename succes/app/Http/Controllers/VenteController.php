<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Form;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\Vente;
use App\Http\Controllers\CampagneController;
use DB;

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
        $ventes= DB::table('campagnes')
        ->join('ventes', function ($join) {
            $join->on('ventes.campagne_id', '=', 'campagnes.id')->whereStatus(['status'=>'EN COURS']);
        })
        ->SimplePaginate(10);
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
          Str::lower($request->campagne);
          //dump($request->acheteur);
          // dd($request->events);


        $cam= new CampagneController();
       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($request->campagne));

        $rules=[
         //'campagne_id'=>'bail|required',  
         'campagne'=>'bail|required|min:9',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
         'acheteur'=>'required|min:4',
         'events'=>'required|min:4',
         //'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);

        
       Vente::create([

            'campagne_id'=>$campagne_id,
            'campagne'=>Str::lower($request->campagne),
            'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
            'acheteur'=>$request->acheteur,
            'contact'=>$request->contact,
            'events'=>$request->events,
            'obs'=>$request->obs
    ]);

      
        return redirect()->route('vente'); 


        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ventes=Vente::findOrFail($id);
        return view('ventes.show',compact('ventes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ventes=Vente::findOrFail($id);
        return view('ventes.edit',compact('ventes'));
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
        $ventes=Vente::findOrFail($id);
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

        
       $ventes->update([

            'campagne_id'=>$request->campagne_id,
            'campagne'=>Str::lower($request->campagne),
            'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
            'acheteur'=>$request->acheteur,
            'contact'=>$request->contact,
            'events'=>$request->events,
            'obs'=>$request->obs
    ]);

      
        return redirect()->route('ventes.show',$id); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vente::destroy($id);
        return redirect()->route('vente');
    }

    public function selectAllSaleForOneCampagne($id){

   $result=array(); 
       $collections=DB::table('ventes')->whereCampagneId($id)->get();

        $result=$collections->toArray();
       // $result = json_decode($result, true);

       return  $result;
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
 
}
