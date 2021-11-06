<?php

namespace App\Http\Controllers;

use App\Campagne;
use Illuminate\Http\Request;
use App\Model\Maladie;
use Carbon\Carbon;

class MaladieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        //dd("here");
        try {
            $maladies=Maladie::orderBy('id', 'desc')->paginate(5);

        } catch (\Throwable $th) {
            return "Error lors de la recuperation des cas de maladies";
        }
       
        //dd($maladies);
        return view('maladies.index', compact('maladies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maladies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $day=0;
        try {
            $id=Campagne::whereIntitule($request['campagne'])->get('id');
            if (isset($id[0]['id'])) {
                //dd($id[0]['id']);
                $datearrivePousin=Campagne::find($id[0]['id'])
                    ->poussins()->where('campagne_id', $id[0]['id'])
                    ->get('date_achat'); 
                // dd($datearrivePousin);
                if (isset($datearrivePousin[0]['date_achat'])) {
                    $datearrivePousin=$datearrivePousin[0]['date_achat'];
                    // dd($datearrivePousin);
                } else {
                    return "Erreur date arrivé poussin introuvable ";
                }

                $jour=  $this->calculeNbrJours($request['date'], $datearrivePousin);
                //  dd($jour);
                Maladie::create(
                    [
                        'date'=>$request['date'], //datee à la maladie a été observée
                        'campagne_id'=>$id[0]['id'],
                        'campagne'=>$request['campagne'],
                        'jours'=>$jour,
                        'symptomes'=>$request['sympt'],
                        'traitements'=>$request['treat']

                    ]
                );

                return redirect()->route('maladies.index')
                    ->with('success', 'Enregistremet reussie avec success ');


                 

            } else {
                return "<b> Insertion maladie impossible campagne introuvable: </b>";
            }
            

        } catch (\Throwable $th) {
             //return $th;
            return "<b> Insertion  impossible: </b>";
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
            $maladie=Maladie::findorFail($id);
        } catch (\Throwable $th) {
            return view('maladies.show', compact('maladie'));
        }

        return view('maladies.show', compact('maladie'));
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
            $maladie=Maladie::findorFail($id);
        } catch (\Throwable $th) {
            return " Impossible de modifier maladie id ".$id. " introuvable";
        } 
       // dd($maladie);
        return view('maladies.edit', compact('maladie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
        // dd($request, $id);
        try 
        {
            $maladie=Maladie::findorFail($id);
            if ($maladie['campagne']==$request['campagne']) {

                //dd("Yes", $maladie['campagne'], $request['campagne']);
                if ($maladie['date']==$request['date']) {
                    //dd("date equal");
                    $maladie->update(
                        [
                         'symptomes'=>$request['sympt'],
                         'traitements'=>$request['treat']

                        ]
                    );

                } else {

                    $datearrivePousin=Campagne::find($maladie['id'])
                        ->poussins()->where('campagne_id', $maladie['id'])
                        ->get('date_achat'); 
                    if (isset($datearrivePousin[0]['date_achat'])) {
                            $datearrivePousin=$datearrivePousin[0]['date_achat'];
                            // dd($datearrivePousin);
                    } else {
                            return "Erreur date arrivé poussin introuvable ";
                    }
                    $jour=$this->calculeNbrJours($datearrivePousin, $request['date']);
                    $maladie->update(
                        [
                         'date'=>$request['date'],
                         'jours'=>$jour,
                         'symptomes'=>$request['sympt'],
                         'traitements'=>$request['treat']

                        ]
                    );


                }
                
            } else {
                try {
                    $id=Campagne::whereIntitule($request['campagne'])->get('id');
                    if (isset($id[0]['id'])) {
                        $datearrivePousin=Campagne::find($id[0]['id'])
                            ->poussins()->where('campagne_id', $id[0]['id'])
                            ->get('date_achat'); 

                        if (isset($datearrivePousin[0]['date_achat'])) {
                                $datearrivePousin=$datearrivePousin[0]['date_achat'];
                                // dd($datearrivePousin);
                        } else {
                            return "Erreur date arrivé poussin introuvable ";
                        }
            
                        $jour=  $this->calculeNbrJours($request['date'], $datearrivePousin);
                            //  dd($jour);
                        Maladie::create(
                            [
                                'date'=>$request['date'], //datee à la maladie a été observée
                                'campagne_id'=>$id[0]['id'],
                                'campagne'=>$request['campagne'],
                                'jours'=>$jour,
                                'symptomes'=>$request['sympt'],
                                'traitements'=>$request['treat']
            
                            ]
                        );
            
                        
                    } else {
                        return " Erreur campagne ".$request['campagne'];
                    }
                    
                   
                } catch (\Throwable $th) {
                    return " Erreur campagne ".$request['campagne'];
                }

                dd($maladie['campagne'], $request['campagne']);
            }
            
             
        } catch (\Throwable $th) {
            return "Maladie introuvable with this id: ".$id;
        }
       
        return view('maladies.show', compact('maladie'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * Calcule_nbr_jours
     *
     * @return $result
     */
    public function calculeNbrJours($datearrived,$datemaladie)
    { 
        $datearrived= new Carbon($datearrived);
        $datemaladie= new Carbon($datemaladie);
       
        $jours=$datemaladie->diffInDays($datearrived);
        return  $jours;
        
    } 
    
    /**
     * BeforeUpdate
     *
     * @param  mixed $old
     * 
     * @param  mixed $new
     * 
     * @return $result
     */
    public function beforeUpDateMaladie($old, $new)
    {
        dd($old, $new);
        if ($old['campagne']==$new['campagne']) {
           
        } else {
           
        }
       
    }
}
