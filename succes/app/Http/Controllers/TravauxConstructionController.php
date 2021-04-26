<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ConstructionRéparation;

class TravauxConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //dd('here');
        $travaux=ConstructionRéparation::select()
        ->orderByDesc('id')
         ->simplePaginate(10);;
       // dd($travaux);

         if( $travaux->count()>0 )
         {
            // dd('IN -yes') ;

            /* foreach ($travaux as $key => $value) {
                dump($value['materiel']);
            }
          for ($i=0; $i < count($travaux) ; $i++) { 
               dump($travaux[$i]['materiel']);
           }*/
           //  die;

            return view('TravConstruction.index',compact('travaux'));
         }
         return view('TravConstruction.index',compact('travaux'));
        
        // return back()->with('success','Pas de Travaux ou Achats de materiels detectés');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // dd('create ');
        return view('TravConstruction.create');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd('store');

        $rules = [
			// 'campagne_id'=>'bail|required',
			'materiel'      => 'bail|required|min:3',
			'quantite'      => 'bail|required',
			'priceUnitaire' => 'bail|required',
			
		//	'obs'           => 'required|min:3'
        ];
		$this->validate($request, $rules);

      // dd($request->request);
      ConstructionRéparation::create([
            'date' => $request->date_achat,
            'materiel' =>  $request->materiel,
            'quantite' => $request->quantite,
            'PriceUnitaire' => $request->priceUnitaire,
            
            'obs' => $request->obs]);

    //return redirect()->route('head');
    return redirect()->route('travauxconstruction.index')->with('success', 'Materiel enregistré avec success');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materiel=ConstructionRéparation::findOrFail($id);
      // dd($materiel);
        return view('TravConstruction.show', compact(['materiel']));
       // dd('here');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $materiel=ConstructionRéparation::findOrFail($id);
        return view('TravConstruction.edit', compact(['materiel']));
       // dd('edit');
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
        $materiel=ConstructionRéparation::findOrFail($id);
        $rules = [
			// 'campagne_id'=>'bail|required',
			'materiel'      => 'bail|required|min:3',
			'quantite'      => 'bail|required',
			'priceUnitaire' => 'bail|required',
			
		//	'obs'           => 'required|min:3'
        ];
        $materiel->update([
            'date'=>$request->date,
            'materiel'=>$request->materiel,
            'quantite'=>$request->quantite,
            'PriceUnitaire'=>$request->priceUnitaire,
            'obs'=>$request->obs

        ]);
        return redirect()->route('travauxconstruction.show',$id)->with('success','infos modifié avec succes ');
      //  dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ConstructionRéparation::destroy($id);

        return redirect()->route('travauxconstruction.index')->with('success', 'materiel a bien été supprimé de la liste .');
    }
}
