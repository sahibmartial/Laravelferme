<?php

namespace App\Http\Controllers;

use App\Model\Vaccin;
use App\Campagne;
use Illuminate\Http\Request;
use App\Http\Controllers\GeneratePdfController;
use PDF;
class VaccinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaccin= new Vaccin();         
        
      // $vaccin->alertMailingSuivi();
        $resultscampa=$vaccin->infosCampagneStatus("EN COURS");
       //dd($resultscampa);

        if (count($resultscampa)>0) {
            $vaccins= Vaccin::whereCampagneId($resultscampa[0]['id'])
            ->orderByDesc('vaccins.id')
            ->SimplePaginate(10)
             ;
            // dump($vaccins);
            //dd('campagne e cours');
            return view('vaccins.index',compact('vaccins'));
        }
       
        return back()->with('success','Aucun suivi de vaccin en cours actuellement');


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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Vaccin $vaccin,Request $request)
    {  $id=null;
       $suivi= $vaccin->infosCampagneStatus("EN COURS");
     //  dump($suivi);
       $id=$suivi[0]['id'];
     //  dd($id);
         
        $arrayIntervention=[];
        //preparez un array ou je parcours les select et jes ordonne dans une ligne unique pour insertion plus simple 
        
         $select=$request->intitulevaccin;
        //dd($select[0]);
        
        if (count($select)>1) {
            for ($i=0; $i <count($select) ; $i++) { 
                $arrayIntervention[]= array('id_camp'=>$id,'campagne'=>$request->campagne,'date'=>$request->datevaccination,'intitulevaccin'=>$select[$i],'obs'=>$request->obs); 
            } 
          //  dd($arrayIntervention);
        }else{
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
                $this->validate($request,$rules);

               if (count($suivi)>=1) {
               // dump($suivi);
                Vaccin::create([
                 'campagne_id'=>$suivi['id_camp'],
                 'campagne'=>$suivi['campagne'],
                 'datedevaccination'=>$suivi['date'],
                 'intitulevaccin'=>$suivi['intitulevaccin'],
                 'obs'=>$suivi['obs']

                ]);
            
               }else{
                throw new \Throwable("");
               }

           } catch (\Throwable $th) {
           // dd($th->getMessage());
            return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
           }
         
        }
      //  die();
      return redirect()->route('vaccins.index')->with('success', 'Vaccination  enregistré avec sucess');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $suivi=Vaccin::findOrFail($id);
       // dd( $suivi->id);
        return view('vaccins.show', compact('suivi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suivi=Vaccin::findOrFail($id);
      //  dd($suivi);
        return view('vaccins.edit',compact('suivi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $suivi=Vaccin::findOrFail($id);
       // dd($request);
        try {
            if ($id) {
                $rules=[
                    'campagne'=>'required|min:9',
                     'datevaccination'=>'bail|required',
                    'intitulevaccin'=>'bail|required',
                    'obs'=>'required|min:3'];
                    $this->validate($request,$rules);
                    
                    $suivi->update([
                        'campagne_id'=>$request->campagne_id,
                        'campagne'=>$request->campagne,
                        'datedevaccination'=>$request->datevaccination,
                        'intitulevaccin'=>$request->intitulevaccin,
                       'obs'=>$request->obs

                    ]);   
            
            }else{
                throw new \Throwable("Modification vaccin impossible");
            }
        } catch (\Throwable $th) {
         //   dd($th->getMessage());
            return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
        }

        return redirect()->route('vaccin')->with('success', 'Vaccin modifié avec sucess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // dd($id);
        Vaccin::destroy($id);
        return redirect()->route('vaccin')->with('success', 'Vaccin  supprimé avec sucess');
    }
    /**
     * form to download recap traitement
     */
    public function recapVaccin()
    {
        return view('vaccins.recapVaccin');
    }
    /**
     * listing traitement vaccin pdf generation du fichier pdf
     */
    public function getRecap(Request $request)
    {   
         $pdf= new GeneratePdfController();

        $vaccin= new Vaccin();
        $data=$vaccin->getRecap($request->campagne);
      //  dd();
        if (count($data)>0) {
            $pdf = PDF::loadView('vaccins.pdf_suivivaccin',['campagne'=>$request->campagne,'data'=>$data]);
       
    
            $reference=date('d/m/Y')."-"."RecapTraitement".$request->campagne."-".uniqid();
           // dd( $reference);
            return $pdf->download($reference.'.pdf');  
        }
        return back()->with('success','Impossible de télécharger pdf, aucun suivi trouvé pour cette campagne');
       
      

    }
    

}
    