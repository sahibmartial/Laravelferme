<?php

namespace App\Http\Controllers;

use App\Campagne;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Transport;
use App\Http\Controllers\CampagneController;
use App\Http\Classe\TransportAction;
class TransportController extends Controller implements TransportAction
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $transports=Transport::all();
        try {
            $transports= DB::table('campagnes')
            ->join('transports', function ($join) {
                $join->on('transports.campagne_id', '=', 'campagnes.id')->whereStatus(['status'=>'EN COURS']);
            })
            ->orderByDesc('transports.id')
            ->SimplePaginate(10);

            //  dd($transports);

            return view('transports.index', compact('transports'));

        } catch (\Throwable $th) {
             throw $th;
        }

    }

    /**
     * SearchTransport
     *
     * @return $result
     */
    public function searchTransport()
    {
        $_REQUEST['searchcampagne'];
        try {
            $transports= DB::table('campagnes')
            ->join('transports', function ($join) {
                $join->on('transports.campagne_id', '=', 'campagnes.id')->whereIntitule(['intitule'=>$_REQUEST['searchcampagne']]);
            })
            ->orderByDesc('transports.id')
            ->SimplePaginate(10);

            return view('transports.index', compact('transports'));

        } catch (\Throwable $th) {
             return "Campagne not found : ".$_REQUEST['searchcampagne'];
        }
        return view('transports.index', compact('transports'));

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
        if ($campagnes) {
            return view('transports.create', compact('campagnes'));
        }

        return back()->with('success', 'Enregistrement  Achat pousssins impossible aucune campagne en cours  ,merci');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dump($request);

        $campagne_id=0;
        $cam= new CampagneController();
        $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($request->campagne));
        //dd($campagne_id);
        $rules=[
         'campagne'=>'bail|required|min:9',
         //'libelle'=>'bail|required|min:3',
         'montant'=>'bail|required',
         //'priceUnitaire'=>'bail|required',
        // 'fournisseur'=>'required|min:4'
         'obs'=>'required|min:3'
        ];
        $this->validate($request, $rules);

        try {
            Transport::create(
                [
                'campagne_id'=>$campagne_id,
                'date_achat'=>$request->date_achat,
                'campagne'=>Str::lower($request->campagne),
                 //'libelle'=>$request->libelle,
                 'montant'=>$request->montant,
                //  'priceUnitaire'=>$request->priceUnitaire,
                 // 'fournisseur'=>$request->fournisseur,
                 'obs'=>$request->obs
                ]
            );


            //return redirect()->route('transport');
             return redirect()->route('transports.index')->with('success', 'Masse has been successfully added');

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
    {
        try {
            $transports=Transport::findOrFail($id);
            return view('transports.show', compact('transports'));
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
            $transports=Transport::findOrFail($id);
            return view('transports.edit', compact('transports'));
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
            //'libelle'=>'bail|required|min:3',
            'montant'=>'bail|required',
           // 'priceUnitaire'=>'bail|required',
           // 'fournisseur'=>'required|min:4'
            'obs'=>'required|min:3'
        ];
        $this->validate($request, $rules);

        try {
            $transports=Transport::findOrFail($id);
            $transports->update(
                [
                'campagne_id'=>$request->campagne_id,
                'date_achat'=>$request->date_achat,
                 'campagne'=>Str::lower($request->campagne),
                 //  'libelle'=>$request->libelle,
                  'montant'=>$request->montant,
                  //  'priceUnitaire'=>$request->priceUnitaire,
                  //'fournisseur'=>$request->fournisseur,
                  'obs'=>$request->obs
                ]
            );
            return redirect()->route('transports.show', $id);

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
        $folder="TransportsRemove/";
        $name=uniqid().'-'.date("Y-m-d H:i:s").'-'.$user->name;
        $filename=$name."."."txt";
        $filebackup= new BackUpFermeController();

        try {
            $value=Transport::findorfail($id);

            $filebackup->backupfile($folder, $filename, $value);

            Transport::destroy($id);
            return redirect()->route('transports.index');

        } catch (\Throwable $th) {
            throw $th;
        }
    }




   /**
    * SelectAllFraisTrasnportForOneCampagne
    *
    * @param  mixed $id
    * @return void
    */
    public function selectAllFraisTrasnportForOneCampagne($id)
    {

        $result=array();
        $collections=DB::table('transports')->whereCampagneId($id)->get();

        $result=$collections->toArray();
         // $result = json_decode($result, true);
        // dd($result);
        return  $result;
    }


    /**
     * CalculateFraisTotalOfCampagne
     *
     * @param  mixed $id
     * @return $result
     */
    public function calculateFraisTotalOfCampagne($id)
    {
        $som=0;

        $result=$this->selectAllFraisTrasnportForOneCampagne($id);

        for ($i=0; $i <count($result); $i++) {

            $som+=$result[$i]->montant;
            //dd($som);
            // $som++;
            // dump($result[$i]->quantite." :".$result[$i]->priceUnitaire) ;
        }
        // dd($som);
        return $som;
    }


    public function allTransports()
    {
        $campagnes = Campagne::all();
        //dd($campagnes);

        return view("transports.allTransports_of_one_campagne", compact('campagnes'));

    }
    /*
    *Show all accessoires of this campagne select
    */

    public function showallTransports()
    {

        //dd('here');

        return view("transports.showallTransports_of_one_campagne");

    }


    public function downloadRecapFrais($data)
    {
         $transport= new Transport();
        $results=$transport->downloadRecapFrais($data);
        return $results;

    }



}
