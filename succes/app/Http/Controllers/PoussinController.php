<?php

namespace App\Http\Controllers;

use App\Campagne;
use App\Http\Controllers\CampagneController;

use App\Model\Poussin;
use App\Model\Vaccin;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
/**
 * ClientController short of the class
 *
 * @category CategoryName
 * @package  PackageName
 * @author   Original Author <author@example.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://pear.php.net/package/PackageName
 */
class PoussinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $arraypoussins = array();
        // dd('poussins');
        //  $poussins= Poussin::all();
        // dump($poussins);
        // $poussins= Poussin::simplePaginate(1);
        // dd($poussins);
        $poussins = DB::table('campagnes')
            ->join('poussins', function ($join) {
                $join->on('poussins.campagne_id', '=', 'campagnes.id')->whereStatus(['status' => 'EN COURS']);
            })
            ->orderByDesc('poussins.id')
            ->SimplePaginate(2);
            // dd($poussins);
           //dump($poussins);
          // dump($arraypoussins[0]);
         return view('poussins.index', compact('poussins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $campagnes=Campagne::whereStatus('EN COURS')->get('intitule');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('success', 'Enregistrement  Achat pousssins impossible aucune campagne en cours  ,merci');
        }
        //dd($campagnes);
        if ($campagnes) {
            return view('poussins.create', compact('campagnes'));
        }

        return back()->with('success', 'Enregistrement  Achat pousssins impossible aucune campagne en cours  ,merci');

    }

    /**
     *  Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $campagne_id = 0;
        $cam= new CampagneController();
        try {
            $campagne_id = $cam->getIntituleCampagneenCours(Str::lower($request->campagne));

            $updateCampagne=Campagne::findorfail($campagne_id);
            //dd($updateCampagne);
        } catch (\Throwable $th) {
            throw $th;
        }


        if (empty($campagne_id)) {

            return back()->with('success', 'Enregistrement  Achat pousssins impossible, '.$request->campagne.' introuvable ,merci');
        } else {
            $errobd="Error database insert thank you";
            try {
                 $rules = [
                    // 'campagne_id'=>'bail|required',
                   'campagne'=> 'bail|required|min:9',
                   'quantite'=> 'bail|required',
                   'priceUnitaire' => 'bail|required',
                   'fournisseur'   => 'required|min:4',
                   'contact'       => 'bail|required'
                  ];


                  $this->validate($request, $rules);

                 //  dd($request);
                    Poussin::create(
                        [
                         'campagne_id'=> $campagne_id,
                         'date_achat'=> $request->date_achat,
                          'campagne'=> Str::lower($request->campagne),
                         'quantite'=> $request->quantite,
                         'priceUnitaire' => $request->priceUnitaire,
                         'fournisseur'=> $request->fournisseur,
                         'phone'=>$request->contact,
                         'obs'=> $request->obs]
                    );


                   //update  duree camapge
                    $updateCampagne->update(
                        [
                        'duree'=>1
                        ]
                    );

                  //step insertion   dans la table vaccin et envoi de mail notification
                 $now=now();
                 //  dd($now);
                 $campagne=Str::lower($request->campagne);
                   $traitement="Arrivée des poussins";
                  $obs="Arrivé poussins dans la ferme ";
                Vaccin::create(
                    [
                     'campagne_id'=>$campagne_id,
                     'campagne'=>Str::lower($request->campagne),
                    'datedevaccination'=>$now,
                    'intitulevaccin'=>$traitement,
                    'obs'=>$obs
                    ]
                );

                //dd("campagne upde and vaccin create");
                $content="Nous sommes le ".$now.", jour 1 de la ".$campagne."<br> <br>";
                $content.="A) <b> Preventions sanitaire </b>:<br/>";
                $content.="1) Pulverisations quotidien tous les 3 jours :<br> <br>";
                $content.="B) <b>Traitements </b>: <br>";
                $content.="2) EAu sucré /Mixtral /BetaSpro-C <br>";

                $vaccin= new Vaccin;
                $vaccin->alertMailingArrivePoussins($content);

                 //Ajout de 40 jours date arrive pour determine date de debut vent
                // echo date('d-m-Y', strtotime('+15 days'));
                // echo $now."\n";
                //echo date($now, strtotime('+40 days'))."\n";
                $date_enter_production=date("d-m-Y", strtotime($now.'+45 days'));
                //  dd($date_enter_production);

                //envoi email debut vente
                $contentVente="<br> Le ".$date_enter_production.", la ".$campagne." rentre en production.<br> <br>";
                $contentVente.="Merci de faire le necessaire en contactant tous nos clients. <br>";
                $contentVente.="Force et Courage à nous, Dieu est au contrôle <br> <br>";
                 $vaccin->alertEmailProduction($campagne, $contentVente);
            } catch (\Throwable $errobd) {
                // dd($th->getMessage());
                return redirect()->route('errorbd')->with('success', $errobd);
            }
            //return redirect()->route('head');
            return redirect()->route('poussins.index')->with('success', 'Poussins declarés avec success');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $lists = Poussin::findOrFail($id);

        } catch (\Throwable $th) {
            throw $th;
        }
        return view('poussins.show', compact('lists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $poussin = Poussin::findOrFail($id);

        } catch (\Throwable $th) {
            throw $th;
        }
        return view('poussins.edit', compact('poussin'));
    }


    /**
     * Update
     *
     * @param  mixed $request
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {

        $rules = [
          'campagne_id'   => 'bail|required',
          'campagne'      => 'bail|required|min:9',
          'quantite'      => 'bail|required',
          'priceUnitaire' => 'bail|required'
          //  'fournisseur'=>'required|min:4',
         //  'obs'=>'required|min:3'
        ];
        $this->validate($request, $rules);
        try {
            $poussin = Poussin::findOrFail($id);
            $poussin->update(
                [
                'campagne_id'   => $request->campagne_id,
                'date_achat'    => $request->date_achat,
                'campagne'      => Str::lower($request->campagne),
                'quantite'      => $request->quantite,
                'priceUnitaire' => $request->priceUnitaire,
                'fournisseur'   => $request->fournisseur,
                'obs'           => $request->obs
                ]
            );
            return redirect()->route('poussins.show', $id);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $user=Auth()->user();
            $folder="PoussinRemove/";
            $name=uniqid().'-'.date("Y-m-d H:i:s").'-'.$user->name;
            $filename=$name."."."txt";
            $filebackup= new BackUpFermeController();
            $value=Poussin::findorfail($id);
            $filebackup->backupfile($folder, $filename, $value);

            Poussin::destroy($id);

        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('head');
    }


    /**
     * SelectAllheadForOneCampagne
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function selectAllheadForOneCampagne($id)
    {
        $poussin= new Poussin();

        $result=$poussin-> selectAllheadForOneCampagne($id);

         return $result;
    }


    public function calculateAchatHeadOfThisCampagne($id)
    {

        $poussin= new Poussin();

        $som =$poussin->calculateAchatHeadOfThisCampagne($id);
        return $som;
    }

    public function selectheadForOneCampagne($id)
    {
        $poussin= new Poussin();
        $result = $poussin->selectheadForOneCampagne($id);
        return $result;

    }

    /**
     * GetQte_Priceof_AchatsPoussins_ForThisCampagne
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function getQte_Priceof_AchatsPoussins_ForThisCampagne($id)
    {

        $poussin= new Poussin();

        $result = $poussin->getQte_Priceof_AchatsPoussins_ForThisCampagne($id);

        //dd($result);
        return $result;

    }


    /**
     * DownloadRecapPoussin
     *
     * @param  mixed $data
     *
     * @return void
     */
    public function downloadRecapPoussin($data)
    {

        $poussin= new Poussin();
        $results=$poussin->downloadRecapPoussin($data);
        // dd($results);
        return $results;

    }
}
