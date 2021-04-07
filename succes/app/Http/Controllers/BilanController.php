<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Bilan;
use App\Campagne;
use App\Http\Controllers\GeneratePdfController;
use Illuminate\Support\Str;
use PDF;

class BilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bilans=Bilan::all();

        return view('bilans.index',compact('bilans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bilans=Bilan::findOrFail($id);
         return view('bilans.show', compact('bilans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bilans=Bilan::findOrFail($id);
        return view('bilans.edit',compact('bilans'));
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
         $bilans=Bilan::findOrFail($id);
        $rules=[
            'obs'=>'required|min:3'
           // 'start'=>'bail|required',
           // 'status'=>'required|min:7'
        ];
        $this->validate($request,$rules);
      //  dd('store');
        $bilans->update([
           // 'title'=>$request->intitule,
           // 'start'=>$tarted,
          //  'status'=>$request->status,
            'obs'=>$request->obs
        ]);

       return redirect()->route('bilans.show',$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bilan_achats_campagne_en_cours(){

   
       return view('bilans.bilan_achats_encours');
    
  }

   public function getBilan_achats_campagne_en_cours(Request $request){
    $apportVente=$apportpersonel=$budget=null;
   $bilan= new Bilan();
   $cam= new Campagne();
   $campagneInfos= $bilan->getInfosCampagne(Str::lower($request->campagne));
  // dd($campagneInfos,$campagneInfos[0]['budget']);
   //dd($campagneInfos->isNotEmpty());
   if ($campagneInfos->isNotEmpty()) {
     $budget=$campagneInfos[0]['budget'];
     $campagne_id=$campagneInfos[0]['id'];
     $apports=$cam->getApport($campagne_id);//recu  apport of campagne

   if(!empty($apports)){
    foreach ($apports as $key => $value) {
     //dump($value['obs']);
     if ($value['obs']=='Apport issu des Ventes') {
       $apportVente+=$value['apport'];
     }else{
      $apportpersonel+=$value['apport'];
     }
    
   }

   }

   }
   
  
   
   //dd($apportVente,$apportpersonel);
   
       $notification=null;
      $campagne=$request->campagne;
     // dd($request->campagne);
      $notification=" La ".$campagne." est Cloturée ou introuvable.";
       return view('bilans.getDetailAchatsBilan',compact('campagne','notification','budget','apportVente','apportpersonel'));
    
  }


  /**
   * 
   */
   public function getBilan_detaille()
   {
     return view('bilans.bilanCompletCampagne');

   }
   /**
   * 
   */
   public function downloadBilan_detaille(Request $request)
   {
    // dd($request->campagne);
   
      $pdf=new GeneratePdfController();
     $results=$pdf->downloadRecapDetailCampagne(Str::lower($request->campagne));

  // dd($results);
    // dd($results['Poussin']);
    /* foreach ( $results as $key => $value) {
        if ($key=='Poussin' && empty($value)) {
        echo "Campagne terminé";
        return;
        }else{
            if ($key=='Aliment') {
                if (empty($value['Data'])) {
                    echo "Empty";
                }else{
                  for ($i=0; $i <count($value['Data']); $i++) { 
                    if(count($value['Data'])==1){
                        dump($value['Data'][0]);
                    }else{
                       dump($value['Data'][$i]);
                    }
                    
                 }  
                }
                          
            }
         
        }
     }
     dd($results);*/

    //dd($results['Campagne']);
      $pdf = PDF::loadView('bilans.pdf_bilan',['results'=>$results,'campagne'=>Str::lower($request->campagne)]);
     //dd($data);

     $reference=date('d/m/Y')."-"."Recap"."-".Str::lower($request->campagne)."-".uniqid();
     return $pdf->download($reference.'.pdf'); 




   }
    

}
