<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Poussin;

class PoussinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd('poussins');
         $poussins= Poussin::all();
        return view('poussins.index',compact('poussins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('poussins');
        return view('poussins.create');
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
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
         'fournisseur'=>'required|min:4',
         'obs'=>'required|min:3'];
        $this->validate($request,$rules);


        Poussin::create(['campagne'=>$request->campagne,'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
            'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs]);

      
        return redirect()->route('head');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lists=Poussin::findOrFail($id);
         return view('poussins.show', compact('lists'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $poussin=Poussin::findOrFail($id);
         return view('poussins.edit',compact('poussin'));
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
        $poussin=Poussin::findOrFail($id);

        $rules=[
         'campagne'=>'bail|required|min:9',
         'quantite'=>'bail|required'
     //    'priceUnitaire'=>'bail|required',
       //  'fournisseur'=>'required|min:4',
       //  'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);

        
        $poussin->update(['campagne'=>$request->campagne,'quantite'=>$request->quantite
        //    'priceUnitaire'=>$request->priceUnitaire,
       //     'fournisseur'=>$request->fournisseur,
        //    'obs'=>$request->obs
    ]);

      
        return redirect()->route('head'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Poussin::destroy($id);
        return redirect()->route('head');
    }
}
