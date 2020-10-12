<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Accessoire;

class AccessoireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessoires=Accessoire::all();
        return view('accessoires.index', compact('accessoires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accessoires.create');
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
        // 'fournisseur'=>'required|min:4',
         'obs'=>'required|min:3'];
        $this->validate($request,$rules);

           Accessoire::create(['campagne'=>$request->campagne,
           'libelle'=>$request->libelle,
            'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
           // 'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs]);

      
        return redirect()->route('caccessoires');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // dd('here');
        
         $accessoires=Accessoire::findOrFail($id);
         return view('accessoires.show', compact('accessoires'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $accessoires=Accessoire::findOrFail($id);
         return view('accessoires.edit',compact('accessoires'));
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
       $accessoire=Accessoire::findOrFail($id);

         $rules=[
         'campagne'=>'bail|required|min:9',
         'libelle'=>'bail|required|min:3',
         'quantite'=>'bail|required',
         'priceUnitaire'=>'bail|required',
        // 'fournisseur'=>'required|min:4',
         'obs'=>'required|min:3'];
        $this->validate($request,$rules);

           $accessoire->update(['campagne'=>$request->campagne,
           'libelle'=>$request->libelle,
            'quantite'=>$request->quantite,
            'priceUnitaire'=>$request->priceUnitaire,
           // 'fournisseur'=>$request->fournisseur,
            'obs'=>$request->obs]);

      
        return redirect()->route('accessoires.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Accessoire::destroy($id);
        return redirect()->route('accessoires.index');
    }
}
