<?php

namespace App\Http\Controllers;

use App\Campagne;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\Masse;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\FonctionController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cam= new Campagne();
     //  dd($cam->meanMasse(5));
     //   dd($cam->getDureeCampagne(5));


       try {
        
       // $campagne=Campagne::whereStatus('EN COURS')->get('id');
       // dd($campagne);
      //  $masses=Masse::whereCampagne_id(5)->orderBy('id')->get(); 

        $masses= DB::table('campagnes')
        ->join('masses', function ($join) {
            $join->on('masses.campagne_id', '=', 'campagnes.id')->whereStatus(['status'=>'EN COURS']);
        })
        ->orderByDesc('masses.id')
        ->SimplePaginate(10);
       // dd($masses);
           
       } catch (\Throwable $th) {
           throw $th;
       }

       return view ("masses.index", compact('masses'));

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("masses.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $date=date("Y-m-d");
      //  dd('here');
       $mail= new MailController(); 
         $campagne_id=0;
         $cam= new CampagneController();
         $fonc= new FonctionController();
    $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($request->campagne));
     $year=$fonc->getYear($date);

    //dd($year);
    $rules=[
         //'campagne_id'=>'bail|required',   
         'campagne'=>'bail|required|min:9',
         'mean_masse'=>'bail|required',
         //'priceUnitaire'=>'bail|required',
         //'fournisseur'=>'required|min:4',
         //'obs'=>'required|min:3'
     ];
        $this->validate($request, $rules);

        try {
            $campagne=Campagne::findorfail($campagne_id);

            $qteAliDemarrageUse=$campagne['alimentDemaUtil'];
            $qteAliDemarrageAvailable=$campagne['alimentDemaDispo'];

            $qteAliCroissancUse=$campagne['alimentCroisUtil'];
            $qteAliCroissancAvailable=$campagne['alimentCroisDispo'];

            $users=User::all();

           //step upde aliment utilise 
           if ($request->aliment=='ALIMENT DÉMARRAGE') {
            
            //check qteutiles <= qte disponible 
             if ( $request->quantite <= $qteAliDemarrageAvailable ) {

                Masse::create([
                
                    'campagne_id'=>$campagne_id,
                    'date'=>$request->date,
                    'campagne'=>Str::lower($request->campagne),
                    'aliment'=>$request->aliment,
                    'quantite'=>$request->quantite,
                    'mean_masse'=>$request->mean_masse,
                    //'priceUnitaire'=>$request->priceUnitaire,
                    'annee'=>$year,
                    'obs'=>$request->obs
                ]);

                    $qteUse=$request->quantite+$qteAliDemarrageUse;
                    $qteAvailbe= ($qteAliDemarrageAvailable-$request->quantite);

                    $campagne->update([
                        'alimentDemaDispo'=>$qteAvailbe,
                        'alimentDemaUtil'=>$qteUse
                     ]);
                    
               
                 if($qteAvailbe <=3 ){
                  
                     //send email alerte plus de stoc aliment 
                    $email= "";
                    $subjet="Alerte Suivi aliment  ";
                    $content="Rupture du stock <b>$request->aliment</b> bientôt songer à le renouveler, <br/>";
                    $content.="Merci";

                    foreach ($users as $key => $user) {
                        
                        $mail->emailAlerteAliment($user['email'],$subjet,$content);
                     }     

                 }

             } else {
               
                return redirect()->route('masses.index')->with('success', 'Impossible vous ne pouvez consommer '.$request->quantite.' sacs alors que vous ne disposez de '. 
                $qteAliDemarrageAvailable.' sacs aliments de démarrage ,merci de verifier vos infos');
             }
            

           } elseif($request->aliment=='ALIMENT CROISSANCE') {

          //  dd("here");
         //   dd($qteAliCroissancAvailable,$request->quantite);

            if ($request->quantite <= $qteAliCroissancAvailable ) {


              //  dd('true');
                Masse::create([
                
                    'campagne_id'=>$campagne_id,
                    'date'=>$request->date,
                    'campagne'=>Str::lower($request->campagne),
                    'aliment'=>$request->aliment,
                    'quantite'=>$request->quantite,
                    'mean_masse'=>$request->mean_masse,
                    //'priceUnitaire'=>$request->priceUnitaire,
                    'annee'=>$year,
                    'obs'=>$request->obs
                ]);

                $qteUse=$request->quantite + $qteAliCroissancUse;
                $qteAvailbe= ($qteAliCroissancAvailable-$request->quantite);
                $campagne->update([
                    'alimentCroisDispo'=>$qteAvailbe,
                    'alimentCroisUtil'=>$qteUse
                 ]);


                 if($qteAvailbe <=3){
                  //  $users=User::all();
                     //send email alerte plus de stoc aliment 
                    $email= "";
                    $subjet="Alerte Suivi aliment  ";
                    $content="Rupture du stock <b>$request->aliment</b> bientôt songer à le renouveler, <br/>";
                    $content.="Merci";

                    foreach ($users as $key => $user) {
                        
                        $mail->emailAlerteAliment($user['email'],$subjet,$content);
                     }     

                 }
                
            
            }else{
                return redirect()->route('masses.index')->with('success', 'Impossible vous ne pouvez consommer '.$request->quantite.' sacs alors que vous ne disposez de '. 
                $qteAliCroissancAvailable.' sacs aliments de croissances ,merci de verifier vos infos');
            }

               
           }

            return redirect()->route('masses.index')->with('success', 'Masse ajoutée avec success ');
        } catch (\Throwable $th) {
            throw $th;
        }
        

        //return redirect()->route('masses.index'); 
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $masses=Masse::findOrFail($id);
            return view('masses.show', compact('masses'));
            
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
        try {
            $masses=Masse::findOrFail($id);
         return view('masses.edit', compact('masses'));
            
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
       // dd($request->campagne_id);
        $rules=[
         //'campagne_id'=>'bail|required',   
         'campagne'=>'bail|required|min:9',
         'mean_masse'=>'bail|required',
         //'priceUnitaire'=>'bail|required',
         //'fournisseur'=>'required|min:4',
         'obs'=>'required|min:3'];

        $this->validate($request,$rules);
         try {
          // dd($request);
            $masses=Masse::findOrFail($id);
            $camp=Campagne::findOrFail($masses['campagne_id']);
           // dd($camp);
      
                  if ($request->aliment=='ALIMENT CROISSANCE') {

                      $previousCroisssance=$masses['quantite'];

                      $croissUse=$camp['alimentCroisUtil']-$previousCroisssance;
                      $croissAvailbe=$camp['alimentCroisDispo']+$previousCroisssance;

                      //check a nouveau que qte inferieur a disponible avt de update 

                      if ($request->quantite <= $camp['alimentCroisDispo'] ) {

                            //rammene campagne au valeur precedente aliUse and ali Dispo
                                $camp->update([
                                'alimentCroisUtil'=>$croissUse,
                                'alimentCroisDispo'=>$croissAvailbe
                            ]);


                            $masses->update([
                            'date'=>$request->date,
                            // 'campagne_id'=>$request->campagne_id,
                            'campagne'=>Str::lower($request->campagne),
                            'aliment'=>$request->aliment,
                            'quantite'=>$request->quantite,
                            'mean_masse'=>$request->mean_masse,
                            'obs'=>$request->obs
                            ]);  

                            //step update campagne
                            $croissUse=$camp['alimentCroisUtil']+$request->quantite;
                            $croissAvailbe= $camp['alimentCroisDispo']-$request->quantite;
                            $camp->update([
                                'alimentCroisUtil'=>$croissUse,
                                'alimentCroisDispo'=>$croissAvailbe
                            ]);

                          
                        } else {
                        return redirect()->route('masses.index')->with('success', 'Impossible vous ne pouvez consommer '.$request->quantite.' sacs alors que vous ne disposez de '. 
                        $camp['alimentCroisDispo'].' sacs aliments de croissances ,merci de verifier vos infos');
                       }
                    }

                   if ($request->aliment=='ALIMENT DÉMARRAGE') {
                    $previousDemarrage=$masses['quantite'];

                    $demarrageUse=$camp['alimentDemaUtil'] - $previousDemarrage;
                    $demarrageAvailable=$camp['alimentDemaDispo'] + $previousDemarrage;

                   // dd($demarrageUse, $demarrageAvailbe);

                        if ($request->quantite <= $camp['alimentDemaDispo']) {

                            //rammene campagne au valeur precedente aliUse and ali Dispo
                            $camp->update([
                                'alimentDemaUtil'=>$demarrageUse,
                                'alimentDemaDispo'=> $demarrageAvailable
                            ]);

                            $masses->update([
                                'date'=>$request->date,
                                // 'campagne_id'=>$request->campagne_id,
                                'campagne'=>Str::lower($request->campagne),
                                'aliment'=>$request->aliment,
                                'quantite'=>$request->quantite,
                                'mean_masse'=>$request->mean_masse,
                                'obs'=>$request->obs
                                ]);  
    
                                //step update campagne
                                $newUse=$camp['alimentDemaUtil']+$request->quantite;
                                $newAvailbe= $camp['alimentDemaDispo']-$request->quantite;
                                $camp->update([
                                    'alimentDemaUtil'=>$newUse,
                                    'alimentDemaDispo'=>$newAvailbe
                                ]);
                        
                        } else {
                            return redirect()->route('masses.index')->with('success', 'Impossible vous ne pouvez consommer '.$request->quantite.' sacs alors que vous ne disposez de '. 
                            $camp['alimentDemaDispo'].' sacs aliments demarrage ,merci de verifier vos infos');
                        }         
                     
                   }

                  if ($request->aliment=='Choisir'){
                    return redirect()->route('masses.show',$id)->with('notif','Veuillez precisez le type Aliment modification impossible,merci'); 
                  }

                      
              return redirect()->route('masses.show',$id)->with('success','Masse modifiée avec success'); 
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
        //dd($user->name);
        $folder="MasseRemove/";
        $name=uniqid().'-'.date("Y-m-d H:i:s").'-'.$user->name;
        $filename=$name."."."txt";
        $filebackup= new BackUpFermeController();
        try {
           $value=Masse::findorfail($id);   
           $camp=Campagne::findOrFail($value['campagne_id']);  
           $filebackup->backupfile($folder,$filename,$value);

            //step retire value de campagne 
         //   dd($value);

            if ($value['aliment']=='ALIMENT DÉMARRAGE') {
                $newUse=$camp['alimentDemaUtil']- $value->quantite;
                $newAvailbe= $camp['alimentDemaDispo']+$value->quantite;
                $camp->update([
                    'alimentDemaUtil'=>$newUse,
                    'alimentDemaDispo'=> $newAvailbe
                ]);
            } elseif($value['aliment']=='ALIMENT CROISSANCE') {
                $croissUse=$camp['alimentCroisUtil']-$value->quantite;
                $croissAvailbe=$camp['alimentCroisDispo']+$value->quantite;
                $camp->update([
                    'alimentCroisUtil'=>$croissUse,
                    'alimentCroisDispo'=>$croissAvailbe
                ]);

            }
            
            //step remove
            Masse::destroy($id);
            //return back()->with('info', 'La massse a bien été supprimée dans la base de données.');
            return redirect()->route('masses.index');
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
}
