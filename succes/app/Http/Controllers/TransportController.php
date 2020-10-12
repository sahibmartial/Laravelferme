<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Transport;
class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transports=Transport::all();

        return view('transports.index',compact('transports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transports.create');
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
         'campagne_id'=>'bail|required',
         'campagne'=>'bail|required|min:9',
         //'libelle'=>'bail|required|min:3',
         'montant'=>'bail|required',
         //'priceUnitaire'=>'bail|required',
        // 'fournisseur'=>'required|min:4'
         'obs'=>'required|min:3'
         ];
        $this->validate($request,$rules);

           Transport::create([
            'campagne_id'=>$request->campagne_id,
            'campagne'=>$request->campagne,
           //'libelle'=>$request->libelle,
            'montant'=>$request->montant,
          //  'priceUnitaire'=>$request->priceUnitaire,
           // 'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs]);

      
        return redirect()->route('transport');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transports=Transport::findOrFail($id);
        return view('transports.show',compact('transports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $transports=Transport::findOrFail($id);
         return view('transports.edit',compact('transports'));
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
         $transports=Transport::findOrFail($id);

         $rules=[
         'campagne_id'=>'bail|required',  
         'campagne'=>'bail|required|min:9',
         //'libelle'=>'bail|required|min:3',
         'montant'=>'bail|required',
        // 'priceUnitaire'=>'bail|required',
        // 'fournisseur'=>'required|min:4'
         'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);

          $transports->update([
            'campagne_id'=>$request->campagne_id,
            'campagne'=>$request->campagne,
         //  'libelle'=>$request->libelle,
            'montant'=>$request->montant,
          //  'priceUnitaire'=>$request->priceUnitaire,
            //'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs
        ]);

      
        return redirect()->route('transports.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transport::destroy($id);
        return redirect()->route('transports.index');
    }
}
