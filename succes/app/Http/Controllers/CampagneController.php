<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campagne;

class CampagneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      //  dd('index');
       $campagnes= Campagne::all();
        return view('campagnes.index',compact('campagnes'));
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
          $tarted=date("Y-m-d ");

         $rules=[
            'title'=>'required|min:9',
           // 'start'=>'bail|required',
         'status'=>'required|min:7'];
        $this->validate($request,$rules);
       // dd('store');
        Campagne::create([
            'intitule'=>$request->title,
             'start'=>$tarted,
            'status'=>$request->status]);
      
        return redirect()->route('home');   

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

        $campagnes=Campagne::findOrFail($id);
         return view('campagnes.show', compact('campagnes'));

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
        $tarted=date("Y-m-d ");
        $campagnes=Campagne::findOrFail($id);

        $rules=[
            'title'=>'required|min:9',
           // 'start'=>'bail|required',
            'status'=>'required|min:7'];
        $this->validate($request,$rules);
      //  dd('store');
        $campagnes->update([
            //'title'=>$request->intitule,
            'start'=>$tarted,
            'status'=>$request->status]);

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
        return redirect()->route('home');
    }

    
}
