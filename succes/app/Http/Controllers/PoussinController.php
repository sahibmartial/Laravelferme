<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CampagneController;

use App\Model\Poussin;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PoussinController extends Controller {

    

     //$test = new Poussin();

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
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
			->SimplePaginate(2);
		// dd($poussins);
		///dump($poussins);
		// dump($arraypoussins[0]);

		/*foreach ($arraypoussins as $key => $value) {
		echo $value->campagne."\n";
		}*/

		/*for ($i=0; $i <count($poussins) ; $i++) {
		$arraypoussins[]=$poussins[$i];
		}*/

		//dd($poussins[0]->id);
		// $poussins=$poussins[0];

		//$poussins= Poussin::whereCampagne_id();
		return view('poussins.index', compact('poussins'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//dd('poussins');
		return view('poussins.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$campagne_id = 0;
		/* $cam= new CampagneController();
		$id=$cam->getCampagneenCours();

		for ($i=0; $i <$id->count(); $i++) {
		//dd($id);
		$resultid[]=$id[$i]->id;
		$resultname[]=$id[$i]->intitule;

		if($request->campagne == $id[$i]->intitule){
		$campagne_id=$id[$i]->id;
		}

		}*/
		/*$fonc=new FonctionController();
		$campagne_id=$fonc->getIdcampagne($request->campagne);
		//check campagne_id
		$resultname=$fonc->getlistcampagneencours();
		if (in_array($request->campagne, $resultname)) {
		//dd($campagne_id);
		}else{
		//dd('not found');

		echo "Error veuillez selectionez la bonne campagne !!!\n";
		}*/

		$cam         = new CampagneController();
		$campagne_id = $cam->getIntituleCampagneenCours(Str::lower($request->campagne));

		// dd($request->campagne);

		$rules = [
			// 'campagne_id'=>'bail|required',
			'campagne'      => 'bail|required|min:9',
			'quantite'      => 'bail|required',
			'priceUnitaire' => 'bail|required',
			'fournisseur'   => 'required|min:4',
			'obs'           => 'required|min:3'];
		$this->validate($request, $rules);

		Poussin::create([
				'campagne_id'   => $campagne_id,
				'date_achat'    => $request->date_achat,
				'campagne'      => Str::lower($request->campagne),
				'quantite'      => $request->quantite,
				'priceUnitaire' => $request->priceUnitaire,
				'fournisseur'   => $request->fournisseur,
				'obs'           => $request->obs]);

		//return redirect()->route('head');
		return redirect()->route('poussins.index')->with('success', 'Poussins has been successfully added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$lists = Poussin::findOrFail($id);
		return view('poussins.show', compact('lists'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$poussin = Poussin::findOrFail($id);
		return view('poussins.edit', compact('poussin'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$poussin = Poussin::findOrFail($id);

		$rules = [
			'campagne_id'   => 'bail|required',
			'campagne'      => 'bail|required|min:9',
			'quantite'      => 'bail|required',
			'priceUnitaire' => 'bail|required'
			//  'fournisseur'=>'required|min:4',
			//  'obs'=>'required|min:3'
		];
		$this->validate($request, $rules);

		$poussin->update([
				'campagne_id'   => $request->campagne_id,
				'date_achat'    => $request->date_achat,
				'campagne'      => Str::lower($request->campagne),
				'quantite'      => $request->quantite,
				'priceUnitaire' => $request->priceUnitaire,
				'fournisseur'   => $request->fournisseur,
				'obs'           => $request->obs
			]);

		return redirect()->route('poussins.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		Poussin::destroy($id);
		return redirect()->route('head');
	}

	/**
	 *
	 */

	public function selectAllheadForOneCampagne($id) {
		$poussin= new Poussin();
        dd($id);
		$result=$poussin-> selectAllheadForOneCampagne($id);
		 dd($result);
		return $result;
	}

	/**
	 *
	 */

	public function calculateAchatHeadOfThisCampagne($id) {

		$poussin= new Poussin();

		$som =$poussin->calculateAchatHeadOfThisCampagne($id);

		
		return $som;
	}

	/**
	 *
	 */

	public function selectheadForOneCampagne($id) 
	{
		 $poussin= new Poussin();
		 $result = $poussin->selectheadForOneCampagne($id);	
		 return $result;	

	}

    public function getQte_Priceof_AchatsPoussins_ForThisCampagne($id) {

        $poussin= new Poussin();

      $result = $poussin->getQte_Priceof_AchatsPoussins_ForThisCampagne($id);

      //dd($result);
      return $result;

    }

	/**
	 *cette fonction recupere les infos sur une campagnes pour le pdf 
	 */

     public function downloadRecapPoussin($data)
   {

   	$poussin= new Poussin();
    $results=$poussin->downloadRecapPoussin($data);
   // dd($results);
    return $results;

   }

}
