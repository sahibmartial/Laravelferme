<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Aliment;

class AlimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //dd('here');
         $aliments=Aliment::all();
         return view('aliments.index',compact('aliments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('here');
        return view('aliments.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $rules=[
         'campagne'=>'bail|required|min:9',
         'libelle'=>'bail|required|min:3',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
         'fournisseur'=>'required|min:4'
         //'obs'=>'required|min:3'
         ];
        $this->validate($request,$rules);

           Aliment::create(['campagne'=>$request->campagne,
           'libelle'=>$request->libelle,
            'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
            'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs]);

      
        return redirect()->route('campaliments');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $aliments=Aliment::findOrFail($id);
         return view('aliments.show', compact('aliments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aliments=Aliment::findOrFail($id);
         return view('aliments.edit',compact('aliments'));
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
        $aliments=Aliment::findOrFail($id);

         $rules=[
         'campagne'=>'bail|required|min:9',
         'libelle'=>'bail|required|min:3',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
         'fournisseur'=>'required|min:4'
         //'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);

           $aliments->update(['campagne'=>$request->campagne,
           'libelle'=>$request->libelle,
            'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
            'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs
        ]);

      
        return redirect()->route('aliments.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Aliment::destroy($id);
        return redirect()->route('aliments.index');
    }
}
