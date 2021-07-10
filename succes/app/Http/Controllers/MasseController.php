<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\Masse;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\FonctionController;

class MasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try {
        $masses=Masse::all(); 
           
       } catch (\Throwable $th) {
           throw $th;
       }

       return view ("masses.index",compact('masses'));

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("masses.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $date=date("Y-m-d");
      //  dd('here');
         $campagne_id=0;
         $cam= new CampagneController();
         $fonc= new FonctionController();
    $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($request->campagne));
     $year=$fonc->getYear($date);

    //dd($year);
    $rules=[
         //'campagne_id'=>'bail|required',   
         'campagne'=>'bail|required|min:9',
         'mean_masse'=>'bail|required',
         //'priceUnitaire'=>'bail|required',
         //'fournisseur'=>'required|min:4',
         //'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);

        try {

            Masse::create([
                'campagne_id'=>$campagne_id,
                'campagne'=>Str::lower($request->campagne),
                'mean_masse'=>$request->mean_masse,
                //'priceUnitaire'=>$request->priceUnitaire,
                'annee'=>$year,
                'obs'=>$request->obs
            ]);
            return redirect()->route('masses.index')->with('success', 'Masse has been successfully added');
        } catch (\Throwable $th) {
            throw $th;
        }
        

        //return redirect()->route('masses.index'); 
       

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
            $masses=Masse::findOrFail($id);
            return view('masses.show', compact('masses'));
            
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
            $masses=Masse::findOrFail($id);
         return view('masses.edit', compact('masses'));
            
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
         //'campagne_id'=>'bail|required',   
         'campagne'=>'bail|required|min:9',
         'mean_masse'=>'bail|required',
         //'priceUnitaire'=>'bail|required',
         //'fournisseur'=>'required|min:4',
         'obs'=>'required|min:3'];

        $this->validate($request,$rules);
         try {
            $masses=Masse::findOrFail($id);
            $masses->update([
                // 'campagne_id'=>$request->campagne_id,
                  'campagne'=>Str::lower($request->campagne),
                  'mean_masse'=>$request->mean_masse,
                  //'priceUnitaire'=>$request->priceUnitaire,
                  //'fournisseur'=>$request->fournisseur,
                  'obs'=>$request->obs]);
      
              return redirect()->route('masses.show',$id); 
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
        $folder="MasseRemove/";
        $name=uniqid().'-'.date("Y-m-d H:i:s");
        $filename=$name."."."txt";
        $filebackup= new BackUpFermeController();
        try {
            $value=Masse::findorfail($id);     
           $filebackup->backupfile($folder,$filename,$value);
            Masse::destroy($id);
            //return back()->with('info', 'La massse a bien été supprimée dans la base de données.');
            return redirect()->route('masses.index');
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
}
