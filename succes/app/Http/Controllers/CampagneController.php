<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Str;
use DB;
use Illuminate\Http\Request;
use App\Campagne;
use App\Model\Bilan;
use App\Model\Apport;
use App\Http\Controllers\PoussinController;
use App\Http\Controllers\AccessoireController;
use App\Http\Controllers\AlimentController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\PerteController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\FonctionController;

use Illuminate\Support\Facades\Auth;
class CampagneController extends Controller
{
    /**
     * Display a listing of the resource when status en cours.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $cam = new Campagne();
        $campagne_id=null;
        
      //  dd('index');
      // $campagnes= Campagne::all();
        $campagnes= Campagne::whereStatus(['status'=>'EN COURS'])->simplePaginate(2);

        //recup id campagne 
        foreach ( $campagnes as $key => $value) {
          $campagne_id=$value['id'];
        }
        
        //recup apports of this campagne and calculate
        $som=$cam->sumApportsOfcampagne($campagne_id);

       
       // dd($campagne_id,$som);
        //send for view 
        return view('campagnes.index',compact(['campagnes','som']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campagnes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
     
      if (Auth::check()) {

        $tarted=date("Y-m-d ");

        $rules=[
          'title'=>'required|min:9',
          'budget'=>'bail|required',
          'status'=>'required|min:7'];
        
       $this->validate($request,$rules);
       dd($request);
       Campagne::create([
           'intitule'=>Str::lower($request->title),
           'budget'=>$request->budget,
            'start'=>$tarted,
           'status'=>$request->status,
           'obs'=>$request->obs
       ]);

        //notification email get current user
        
        $to_name= auth()->user()['name'];
        $to_email=auth()->user()['email'];
        $mail= new MailController;
        $subject="Creation de la ".$request->title ;
        $content="Votre campagne a été crée avec succes";
       $mail->send($to_email,$to_name,$subject,$content);
       return redirect()->route('campagnes.index')->with('success', 'Campagne a été crée avec sucess');     
    }
             
      //  return redirect()->route('/');   
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //  dd('show'); 
      $cam = new Campagne();

        $campagnes=Campagne::findOrFail($id);
        $som=$cam->sumApportsOfcampagne($id);
         return view('campagnes.show', compact(['campagnes','som']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         $campagnes=Campagne::findOrFail($id);
         return view('campagnes.edit',compact('campagnes'));
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
        //dd('update');
        $ended=date("Y-m-d ");
        $status="TERMINE";
        $campagnes=Campagne::findOrFail($id);
        //dd($request);

        $rules=[
            'title'=>'required|min:9',
            'budget'=>'bail|required',
            'status'=>'required|min:7'];
        $this->validate($request,$rules);
      //  dd('store');
        $campagnes->update([
            'title'=>Str::lower($request->intitule),
            'budget'=>$request->budget,
            'status'=>$request->status,
            'obs'=>$request->obs
        ]);

        return redirect()->route('campagnes.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        
        Campagne::destroy($id);

        return back()->with('success', 'La campagne a bien été supprimée dans la base de données.');
        //return redirect()->route('home');
    }
    

    public function selectDateStartCampagne($id){

    // dd( Campagne::select('SELECT  * from campagnes'));
         //Debugbar::startMeasure('query builder');

         $result=DB::table('campagnes')->whereId($id)->get('start');
         //Debugbar::stopMeasure('query builder');
           return $result;

    }
    /*This function calcule duredevie when you give datestart 
    *
    *
    */
    public function calculeDureVie($date1,$date2){
     //$datenow=strtotime(date("Y-m-d"));
    // $date=selectDateStartCampagne();

    $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
    $retour = array();

    $tmp = $diff;
    $retour['second'] = $tmp % 60;

    $tmp = floor( ($tmp - $retour['second']) /60 );
    $retour['minute'] = $tmp % 60;

    $tmp = floor( ($tmp - $retour['minute'])/60 );
    $retour['hour'] = $tmp % 24;

    $tmp = floor( ($tmp - $retour['hour'])  /24 );
    $retour['day'] = $tmp;

    return $retour['day'] ;
    }

   /**
   * select year of the date 
   *
   */
    public function selectYearcreate($id)
    {
          $collections=DB::table('campagnes')->whereId($id)->get('start');

          foreach ($collections as $collection) {
           $result=$collection->start;
         }

          $value = preg_split('/-/', $result, -1, PREG_SPLIT_OFFSET_CAPTURE);

         // dd($value[0][0]);  
     
           return $value[0][0];

    }
    /**
     * this function cloture a cmapgne
     *update  field end and status
     * 
     */
    public function cloturerCampagne()
    {   
       $id=($_GET["id"]);//id campagne
       $apportVente=$ApoortPersonnel=null;

         $cam = new Campagne();
         $apports=$cam->getApport($id);

        if (!empty($apports)) {
          foreach ($apports as $key => $apport) {
            if ($apport['obs']=='Apport issu des Ventes') {
              $apportVente+=$apport['apport'];
            } else {
              $ApoortPersonnel+=$apport['apport'];
            }     
          }
        }

        dd($apportVente,$ApoortPersonnel);
      // dd($bilans);
     //  dump($bilans[0]['campagne']);
      // dd($bilans[0]['totalAchats']);   

    //   dd(auth()->user());
       
     $charges_salaire=20000;
     $reserve=10000;
     $partenaire=0;
     $created_at=date("Y-m-d H:i:s");
     $updated_at=date("Y-m-d H:i:s");

     $ended=date("Y-m-d ");
    

    // dd($year);
     $statut="TERMINE";
     $cloture=DB::table('campagnes')->whereId($_GET["id"])
     ->update(['end'=>$ended,
      'status'=>$statut
    ]);
      //appel bilan 
    //  $year = date('Y', strtotime($ended));
     $year = preg_split('/-/', $ended);
        // dump("Annee : ".$year[0]);
     $poussins=0;
     $nomcampagne="";
     $obs="";
     $fonction=new FonctionController();
     $head= new PoussinController();
     $result=$head->selectAllheadForOneCampagne($id);

     for($i=0; $i <count($result); $i++) { 

      $poussins=$result[$i]->quantite;
      $nomcampagne=$result[$i]->campagne;

    }

          //dump("qte poussins : ".$poussins);
          //dump("Nom campagne : ".$nomcampagne);
    $achatshead=$head->calculateAchatHeadOfThisCampagne($id);
         // dump(" achat poussins :".$achatshead);
    $access= new AccessoireController();
    $achataccessoire=$access->calculateDepenseAccessoireofthiscampagne($id);
          //dump("accessoire :".$achataccessoire);
    $aliment= new AlimentController();
    $achataliment=$aliment->calculateDepenseAlimentofthiscampagne($id);
         // dump("Achat aliment : ".$achataliment);
    $frais= new TransportController();
    $transport=$frais->calculateFraisTotalOfCampagne($id);
         // dump(" Frais transport : ".$transport);
    $perte= new PerteController();
    $perdus=$perte->calculateTotalLossofthiscampagne($id);
         // dump(" quantite perdus ".$perdus);

    $vente=new VenteController();
    $vendus= $vente->calculateVenteOfCampagne($id);
        //  dump(" Total vente : ".$vendus);


          //calacul des total achats
    $totalachats=$achatshead+$achataliment+$achataccessoire+$transport+$charges_salaire;
    $totalvente=$vendus;

    if ($totalvente < $totalachats) {
      $obs= $nomcampagne." deficitaire";
      $ben=$totalvente-$totalachats;
      $charges_salaire=20000;
    //
      DB::table('bilans')->insert([
        'campagne_id' =>$id, 'campagne' =>$nomcampagne,
        'budget'=>$budget,
        'apportVente'=>$apportVente,
        'apportPersonnel'=>$apportPersonnel,
        'totalAchats'=>$totalachats,
        'totalVentes'=>$totalvente,'quantite_achetes'=>$poussins,
        'quantite_perdus'=>$perdus,'benefice'=>$ben,
        'reserve'=>$reserve,'partenaire'=>$partenaire,
        'charges_salariale'=>$charges_salaire,
        'annee'=>$year[0],'obs'=>$obs,'created_at'=>$created_at,
        'updated_at'=>$updated_at
        
      ]
    );

    }else{
      $ben=$totalvente-$totalachats;
      $partenaire=$ben-$reserve;

      $obs=$fonction->generateObsBilan($ben,$nomcampagne);
            //insertion table bilan
      DB::table('bilans')->insert([
        'campagne_id' =>$id, 'campagne' =>$nomcampagne,
        'budget'=>$budget,
        'apportVente'=>$apportVente,
        'apportPersonnel'=>$apportPersonnel,
        'totalAchats'=>$totalachats,
        'totalVentes'=>$totalvente,'quantite_achetes'=>$poussins,
        'quantite_perdus'=>$perdus,'benefice'=>$ben,
        'reserve'=>$reserve,'partenaire'=>$partenaire,
        'charges_salariale'=>$charges_salaire,
        'annee'=>$year[0],'obs'=>$obs,'created_at'=>$created_at,
        'updated_at'=>$updated_at

      ]
    );

    }
    //send mail cloture campagne
          $bilans=$this->recapBilan($id);//recup info campagne

         $to_name= auth()->user()['name'];
        $to_email=auth()->user()['email'];
        $mail= new MailController;
        $subject="Cloture de la ".$bilans[0]['campagne'] ;
        $content="Votre campagne a été cloturée avec succes.<br>";
        $content.="Le detail de la campagne ci-dessous.<br>";
        $content.="Intitule : ".$bilans[0]['campagne']. ", Total_Achats: ". $bilans[0]['totalAchats']." FCFA, "."Total_Vente: ".$bilans[0]['totalVentes']." FCFA, "." QtePoussins: ".$bilans[0]['quantite_achetes']." PertePoussins: ".$bilans[0]['quantite_perdus']. " Recettte: ".$bilans[0]['benefice']." FCFA,    Reserve: ". $bilans[0]['reserve']." FCFA,  Partenaire: ".$bilans[0]['partenaire']." FCFA,  Chges Salariales: ".$bilans[0]['charges_salariale']." FCFA,  Obs: ".$bilans[0]['obs'].", Date_start: ".$bilans[0]['created_at']. ", Date_fin".$bilans[0]['updated_at']."<br>";

        //dd($content);
       $mail->send($to_email,$to_name,$subject,$content);

         // dump("observation: ".$obs);

        //  dd("Total achat: ".$totalachats);


    return redirect()->route('bilans.index')->with('success', 'Campagne a été cloturée avec sucess, vous recevrez un mail avec le detail de la campagne'); ;
        
    }

    public function getCampagneenCours()
    {
         $campagnes= Campagne::whereStatus(['status'=>'EN COURS'])->get(['id','intitule','status','start']);
         //$campagnes=(array)$campagnes;
         return $campagnes;
    }


    public function getIntituleCampagneenCours($campagne)
    {

         $result=$this->getCampagneenCours();
        // dd($result);
         for ($i=0; $i <$result->count(); $i++) { 
    //dd($id);
     $resultid[]=$result[$i]->id;
     $resultname[]=$result[$i]->intitule;

      if($campagne == $result[$i]->intitule){
         $campagne_id=$result[$i]->id;
      }

     }

     try {
      if (in_array($campagne, $resultname)) {
        //dd($campagne_id);
        return $campagne_id;
     }else{
        //dd('not found');
      throw new \Exception("Error campagne saisir introuvable, verifier votre saisir !!!\n");
     }
       
     } catch (Exception $e) {
       //echo $e->getMessage();
     }
         
    }


    public function getInfosOneCampagneEnCours($campagne)
    {
     //$resultcampagne = array('id'=>'','intitule'=>'','status'=>'','date-creation'=>'');

     $resultcampagne_encours=$this->getCampagneenCours();

     foreach ($resultcampagne_encours as $key => $value) {

       try {
        if (in_array($campagne,  $value->toArray())) {
          $resultcampagne_encours=$value->toArray();
        //  dd( $result);
          return  $resultcampagne_encours;

        }else{
        //dd('not found');
          throw new \Exception("Error campagne saisir introuvable, verifier votre saisir !!!\n");
        }

      } catch (Exception $e) {
       //echo $e->getMessage();
      }


    }


       //  
  }   

   public function recapBilan($id)
    {
     // $id=2;
      $bilan =new Bilan();
      $infos=$bilan->recapBilan($id);
      //dd($infos);
      return $infos;
    } 


 public function getCapital()
    {
   //  dd("form");
     return view('campagnes.comptable');
    } 

    public function apports()
    {
       $camp = new Campagne();
   $result= $camp->apports();
   dd($result);
     
    } 




    
}
