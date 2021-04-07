<?php

namespace App\Http\Controllers;

use App\Model\Vaccin;
use Illuminate\Http\Request;

class VaccinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaccin= new Vaccin();

        dd($vaccin->infosCampagne(4));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vaccins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrayIntervention=[];
        //preparez un array ou je parcours les select et jes ordonne dans une ligne unique pour insertion plus simple 
        
         $select=$request->intitulevaccin;
        dump($select[0]);
        
        if (count($select)>1) {
            for ($i=0; $i <count($select) ; $i++) { 
                $arrayIntervention[]= array('id_camp' =>4 , 'campagne'=>$request->campagne,'date'=>$request->datevaccination,'intitulevaccin'=>$select[$i],'obs'=>$request->obs); 
            } 

        }else{

        }
     // dd($arrayIntervention);
       
        foreach ($arrayIntervention as $key => $value) {
            dump($value);
          //Vaccin::create($value);
        }
        die();
      return redirect()->route('vaccins.index')->with('success', 'Vaccination  enregistré avec sucess');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccin $vaccin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaccin $vaccin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaccin $vaccin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Vaccin  $vaccin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaccin $vaccin)
    {
        //
    }
}
